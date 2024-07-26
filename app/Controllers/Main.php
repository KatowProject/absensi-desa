<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Absensi;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use DateInterval;
use DatePeriod;
use DateTime;

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

        $start = $this->request->getGet('start') ?? '';
        if (!$start) return $this->fail('Start date is required');

        $end = $this->request->getGet('end') ?? '';
        if (!$end) return $this->fail('End date is required');

        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        $endDate->modify('+1 day');

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($startDate, $interval, $endDate);


        $tgl = [];

        $today = new DateTime();
        foreach ($dateRange as $date) {
            $_ = $m_absensi->db->query(
                "
                SELECT * FROM absensi
                WHERE user_id = ? AND date = ?
            ",
                [$user['id'], $date->format('Y-m-d')]
            )->getRowArray();

            if ($_)
                $tgl[] = $_;
            else {
                $dayOfWeek = date('N', strtotime($date->format('Y-m-d')));
                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    $tgl[] = [
                        'status' => 'Libur',
                        'keterangan' => 'Hari libur akhir pekan',
                        'date' => $date->format('Y-m-d'),
                        'day' => date('D', strtotime($date->format('Y-m-d'))),
                    ];
                } else {
                    if ($date->format('Y-m-d') < $today->format('Y-m-d')) {
                        $tgl[] = [
                            'status' => 'Alpa',
                            'keterangan' => 'Tidak ada data',
                            'date' => $date->format('Y-m-d'),
                            'day' => date('D', strtotime($date->format('Y-m-d'))),
                        ];
                    } else {
                        $tgl[] = [
                            'status' => 'Belum Terlaksana',
                            'keterangan' => 'Tanggal belum melebihi sekarang',
                            'date' => $date->format('Y-m-d'),
                            'day' => date('D', strtotime($date->format('Y-m-d'))),
                        ];
                    }
                }
            }
        }

        // for ($day = 1; $day <= $days; $day++) {

        //     $currentDate = strtotime(date('Y-m-d'));
        //     $checkDate = strtotime(sprintf('%s-%02d-%02d', date('Y', strtotime($date)), date('m', strtotime($date)), $day));

        //     $_ = $m_absensi->db->query("
        //         SELECT * FROM absensi
        //         WHERE user_id = ? AND date = ?
        //     ", [$user['id'], date('Y-m-d', $checkDate)])->getRowArray();

        //     if ($_) {
        //         $_['day'] = date('D', $checkDate);

        //         $tgl[] = $_;
        //     } else {
        //         $dayOfWeek = date('N', $checkDate);
        //         if ($dayOfWeek == 6 || $dayOfWeek == 7) {
        //             $tgl[] = [
        //                 'status' => 'Libur',
        //                 'keterangan' => 'Hari libur akhir pekan',
        //                 'date' => date('Y-m-d', $checkDate),
        //                 'day' => date('D', $checkDate),
        //             ];
        //         } else {
        //             if ($checkDate < $currentDate) {
        //                 $tgl[] = [
        //                     'status' => 'Alpa',
        //                     'keterangan' => 'Tidak ada data',
        //                     'date' => date('Y-m-d', $checkDate),
        //                     'day' => date('D', $checkDate),
        //                 ];
        //             } else {
        //                 $tgl[] = [
        //                     'status' => 'Belum Terlaksana',
        //                     'keterangan' => 'Tanggal belum melebihi sekarang',
        //                     'date' => date('Y-m-d', $checkDate),
        //                     'day' => date('D', $checkDate),
        //                 ];
        //             }
        //         }
        //     }
        // }

        return $this->respond([
            'status' => ResponseInterface::HTTP_OK,
            'message' => 'Success',
            'data' => $tgl,
        ]);
    }

    public function attedance()
    {

        $m_absensi = new Absensi();

        $date = date('Y-m-d');
        $id = session()->get('id');

        $absensi = $m_absensi->where('date', $date)->where('user_id', $id)->first();

        return view('main/attedance', [
            'absensi' => $absensi,
        ]);
    }

    public function submit_attedance()
    {
        $m_absensi = new Absensi();

        $date = date('Y-m-d');
        $id = session()->get('id');

        $absensi = $m_absensi->where('date', $date)->where('user_id', $id)->first();

        if ($absensi) {
            return redirect()->to('/attedance')->with('error', 'Anda sudah melakukan absensi hari ini');
        }

        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('reason');

        // if status hadir set default keterangan "Sudah Melakukan Absensi"
        if ($status == 1) {
            $status = 'Hadir';
            $keterangan = 'Sudah Melakukan Absensi';
        } else if ($status == 2) {
            $status = 'Izin';
        } else if ($status == 3) {
            $status = 'Sakit';
        }

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'user_id' => $id,
            'date' => $date,
            'status' => $status,
            'keterangan' => $keterangan,
            'time' => date('H:i:s'),
        ];

        $m_absensi->insert($data);

        return redirect()->to('/attendance')->with('success', 'Absensi berhasil');
    }
}
