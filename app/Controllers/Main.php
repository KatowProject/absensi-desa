<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Absensi;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('main/home');
    }

    public function absensi()
    {
        $m_user = new User();
        $m_absensi = new Absensi();

        $id = session()->get('id');

        $user = $m_user->where('id', $id)->first();
        if (!$user) return redirect()->to('/login')->with('error', 'User not found');

        $date = $this->request->getGet('date') ?? date('Y-m-d');
        $days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($date)), date('Y', strtotime($date)));

        $tgl = [];
        for ($day = 1; $day <= $days; $day++) {

            $currentDate = strtotime(date('Y-m-d'));
            $checkDate = strtotime(sprintf('%s-%02d-%02d', date('Y', strtotime($date)), date('m', strtotime($date)), $day));

            $_ = $m_absensi->db->query("
                SELECT * FROM absensi
                WHERE user_id = ? AND date = ?
            ", [$user['id'], date('Y-m-d', $checkDate)])->getRowArray();

            if ($_) {
                $_['day'] = date('D', $checkDate);

                $tgl[] = $_;
            } else {
                $dayOfWeek = date('N', $checkDate);
                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    $tgl[] = [
                        'status' => 'Libur',
                        'keterangan' => 'Hari libur akhir pekan',
                        'date' => date('Y-m-d', $checkDate),
                        'day' => date('D', $checkDate),
                    ];
                } else {
                    if ($checkDate < $currentDate) {
                        $tgl[] = [
                            'status' => 'Alpa',
                            'keterangan' => 'Tidak ada data',
                            'date' => date('Y-m-d', $checkDate),
                            'day' => date('D', $checkDate),
                        ];
                    } else {
                        $tgl[] = [
                            'status' => 'Belum Terlaksana',
                            'keterangan' => 'Tanggal belum melebihi sekarang',
                            'date' => date('Y-m-d', $checkDate),
                            'day' => date('D', $checkDate),
                        ];
                    }
                }
            }
        }

        return $this->respond([
            'status' => ResponseInterface::HTTP_OK,
            'message' => 'Success',
            'data' => $tgl,
        ]);
    }
}
