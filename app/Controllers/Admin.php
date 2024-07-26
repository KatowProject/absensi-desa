<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Admin extends BaseController
{
    use ResponseTrait;

    public $char = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
        'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
        'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ',
    ];

    public function index()
    {
        return view('admin/dashboard');
    }

    public function reports()
    {
        $m_user = new User();
        $m_absensi = new Absensi();

        $users = $m_user->get_all();

        $month = $this->request->getGet('bulan') ?? date('m');
        $year =  $this->request->getGet('tahun') ?? date('Y');

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $s = [];

        foreach ($users as &$user) {
            if ($user['role_id'] == 1)
                continue;

            $t = [];
            for ($day = 1; $day <= $days; $day++) {

                $currentDate = strtotime(date('Y-m-d'));
                $checkDate = strtotime(sprintf('%s-%02d-%02d', $year, $month, $day));

                // query sql
                $_ = $m_absensi->db->query("
                    SELECT * FROM absensi
                    WHERE user_id = ? AND date = ?
                ", [$user['id'], date('Y-m-d', $checkDate)])->getRowArray();

                if ($_)
                    $t[$day] = $_;
                else {
                    $dayOfWeek = date('N', $checkDate);
                    if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                        $t[$day] = [
                            'status' => 'Libur',
                            'keterangan' => 'Hari libur akhir pekan',
                        ];
                    } else {
                        if ($checkDate < $currentDate) {
                            $t[$day] = [
                                'status' => 'Alpa',
                                'keterangan' => 'Tidak ada data',
                            ];
                        } else {
                            $t[$day] = [
                                'status' => 'Belum Terlaksana',
                                'keterangan' => 'Tanggal belum melebihi sekarang',
                            ];
                        }
                    }
                }
            }

            $s[] = $user;
            $s[count($s) - 1]['attedance'] = $t;
        }

        $data = [
            'users' => $s,
            'month' => $month,
            'year' => $year,
            'days' => $days,
        ];

        return view('admin/reports', $data);
    }

    public function export_reports()
    {
        $m_user = new User();
        $m_absensi = new Absensi();

        $users = $m_user->get_all();

        $month = $this->request->getGet('bulan') ?? date('m');
        $year =  $this->request->getGet('tahun') ?? date('Y');

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $s = [];

        foreach ($users as &$user) {
            if ($user['role_id'] == 1)
                continue;

            $t = [];
            for ($day = 1; $day <= $days; $day++) {

                $currentDate = strtotime(date('Y-m-d'));
                $checkDate = strtotime(sprintf('%s-%02d-%02d', $year, $month, $day));

                // query sql
                $_ = $m_absensi->db->query("
                    SELECT * FROM absensi
                    WHERE user_id = ? AND date = ?
                ", [$user['id'], date('Y-m-d', $checkDate)])->getRowArray();

                if ($_)
                    $t[$day] = $_;
                else {
                    $dayOfWeek = date('N', $checkDate);
                    if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                        $t[$day] = [
                            'status' => 'Libur',
                            'keterangan' => 'Hari libur akhir pekan',
                        ];
                    } else {
                        if ($checkDate < $currentDate) {
                            $t[$day] = [
                                'status' => 'Alpa',
                                'keterangan' => 'Tidak ada data',
                            ];
                        } else {
                            $t[$day] = [
                                'status' => 'Belum Terlaksana',
                                'keterangan' => 'Tanggal belum melebihi sekarang',
                            ];
                        }
                    }
                }
            }

            $s[] = $user;
            $s[count($s) - 1]['attedance'] = $t;
        }

        $spreadsheet = IOFactory::load('Template-Absensi.xlsx');

        $worksheet = $spreadsheet->getActiveSheet();

        // merge cell from C to length of days
        $worksheet->mergeCells('D1:' . $this->char[$days + 2] . '1');

        // set teks from merge cell
        $worksheet
            ->setCellValue('D1', 'Laporan Absensi ' . date('F Y', strtotime(sprintf('%s-%02d-01', $year, $month))))
            ->getStyle('D1')->getAlignment()->setHorizontal('center');

        $worksheet->getStyle('D1:' . $this->char[$days + 2] . '2')->getBorders()->getAllBorders()->setBorderStyle('thin');

        for ($day = 1; $day <= $days; $day++) {
            $dayOfWeek = date('N', strtotime(sprintf('%s-%02d-%02d', $year, $month, $day)));
            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                $w = $worksheet
                    ->setCellValue($this->char[$day + 2] . '2', $day)
                    ->getStyle($this->char[$day + 2] . '2');

                $w->getAlignment()->setHorizontal('center');
                // color like this #da7f7f
                $w->getFill()->setFillType('solid')->getStartColor()->setRGB('da7f7f');
            } else {
                $w = $worksheet->setCellValue($this->char[$day + 2] . '2', $day);
                $w->getStyle($this->char[$day + 2] . '2')->getAlignment()->setHorizontal('center');
            }
        }

        for ($i = 0; $i < count($s); $i++) {
            $worksheet
                ->setCellValue('A' . ($i + 3), $i + 1)
                ->getStyle('A' . ($i + 3))->getAlignment()->setHorizontal('center');
            $worksheet
                ->getStyle('A' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle('thin');

            $worksheet
                ->setCellValue('B' . ($i + 3), $s[$i]['name'])
                ->getStyle('B' . ($i + 3))->getAlignment()->setHorizontal('center');
            $worksheet
                ->getStyle('B' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle('thin');

            $worksheet
                ->setCellValue('C' . ($i + 3), $s[$i]['jabatan'])
                ->getStyle('C' . ($i + 3))->getAlignment()->setHorizontal('center');
            $worksheet
                ->getStyle('C' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle('thin');


            for ($day = 1; $day <= $days; $day++) {
                $status = $s[$i]['attedance'][$day]['status'];

                $cell = $this->char[$day + 2] . ($i + 3);

                if ($status == 'Alpa') {
                    $worksheet->getStyle($cell)->getFill()->setFillType('solid')->getStartColor()->setARGB('FFFF0000');
                } else if ($status == 'Hadir') {
                    $worksheet->setCellValue($cell, date('H:m', strtotime($s[$i]['attedance'][$day]['time'])));
                    // green, text white
                    $worksheet->getStyle($cell)->getFill()->setFillType('solid')->getStartColor()->setRGB('00FF00');
                    $worksheet->getStyle($cell)->getFont()->setColor(new Color(Color::COLOR_BLACK));
                    $worksheet->getColumnDimension($this->char[$day + 2])->setAutoSize(true);
                } else if ($status == 'Libur') {
                    $worksheet->setCellValue($cell, '-');
                } else if ($status == 'Belum Terlaksana') {
                    $worksheet->setCellValue($cell, '-');
                }

                $worksheet->getStyle($cell)->getAlignment()->setHorizontal('center');
                $worksheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle('thin');
            }
        }


        //    export to xlsx
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Absensi-' . date('F-Y') . '.xlsx"');

        $writer->save('php://output');

        exit;
    }

    public function user()
    {
        $m_user = new User();
        $m_jabatan = new Jabatan();

        $data = [
            'users' => $m_user->get_all(),
            'jabatan' => $m_jabatan->findAll(),
        ];

        return view('admin/user', $data);
    }

    public function create_user()
    {
        $m_user = new User();

        if (!$this->request->isAJAX()) return view('errors/html/error_404');

        $data = $this->request->getRawInput();

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $m_user->insert($data);

        return $this->respondCreated([
            'success' => true,
            'message' => 'User created successfully',
        ], 'User created successfully');
    }

    public function user_detail($id)
    {
        $m_user = new User();

        $is_json = $this->request->getGet('json');

        $user = $m_user->get_by_id($id);
        if (!$user) return view('errors/html/error_404');

        if ($is_json)
            return $this->respond($user, ResponseInterface::HTTP_OK);
        else
            return view('admin/user_detail', ['user' => $user]);
    }

    public function update_user($id)
    {
        $m_user = new User();

        $data = $this->request->getRawInput();

        $user = $m_user->get_by_id($id);
        if (!$user) return $this->respond([
            'success' => false,
            'message' => 'User not found',
        ], ResponseInterface::HTTP_NOT_FOUND);

        if (isset($data['password'])) $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $m_user->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'User updated successfully',
        ], 'User updated successfully');
    }

    public function delete_user($id)
    {
        $m_user = new User();

        $user = $m_user->get_by_id($id);
        if (!$user) return $this->respond([
            'success' => false,
            'message' => 'User not found',
        ], ResponseInterface::HTTP_NOT_FOUND);

        $m_user->delete($id);

        return $this->respondDeleted([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 'User deleted successfully');
    }

    public function jabatan()
    {
        $m_jabatan = new Jabatan();

        $is_json = $this->request->getGet('json');

        $jabatan = $m_jabatan->findAll();
        if ($is_json)
            return $this->respond($jabatan, ResponseInterface::HTTP_OK);
        else
            return view('admin/jabatan', ['jabatan' => $jabatan]);
    }

    public function create_jabatan()
    {
        $m_jabatan = new Jabatan();

        if (!$this->request->isAJAX()) return view('errors/html/error_404');

        $data = $this->request->getRawInput();

        $m_jabatan->insert($data);

        if ($m_jabatan->errors()) return $this->fail($m_jabatan->errors());

        return $this->respondCreated([
            'success' => true,
            'message' => 'Jabatan created successfully',
        ], 'Jabatan created successfully');
    }

    public function jabatan_detail($id)
    {
        $m_jabatan = new Jabatan();

        $is_json = $this->request->getGet('json');

        $jabatan = $m_jabatan->find($id);
        if (!$jabatan) return view('errors/html/error_404');

        if ($is_json)
            return $this->respond($jabatan, ResponseInterface::HTTP_OK);
        else
            return view('admin/jabatan_detail', ['jabatan' => $jabatan]);
    }

    public function update_jabatan($id)
    {
        $m_jabatan = new Jabatan();

        $data = $this->request->getRawInput();

        $jabatan = $m_jabatan->find($id);
        if (!$jabatan) return $this->respond([
            'success' => false,
            'message' => 'Jabatan not found',
        ], ResponseInterface::HTTP_NOT_FOUND);

        $m_jabatan->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'Jabatan updated successfully',
        ], 'Jabatan updated successfully');
    }

    public function delete_jabatan($id)
    {
        $m_jabatan = new Jabatan();

        $jabatan = $m_jabatan->find($id);
        if (!$jabatan) return $this->respond([
            'success' => false,
            'message' => 'Jabatan not found',
        ], ResponseInterface::HTTP_NOT_FOUND);

        $m_jabatan->delete($id);

        return $this->respondDeleted([
            'success' => true,
            'message' => 'Jabatan deleted successfully',
        ], 'Jabatan deleted successfully');
    }

    public function role()
    {
        $role = new Role();

        $roles = $role->findAll();

        return view('admin/role', ["roles" => $roles]);
    }

    public function role_detail($id)
    {
        $m_role = new Role();

        $is_json = $this->request->getGet('json');

        $role = $m_role->find($id);
        if (!$role) return view('errors/html/error_404');

        if ($is_json)
            return $this->respond($role, ResponseInterface::HTTP_OK);
        else
            return view('admin/role_detail', ['role' => $role]);
    }

    public function update_role($id)
    {
        $m_role = new Role();

        $data = $this->request->getRawInput();

        $role = $m_role->find($id);
        if (!$role) return $this->respond([
            'success' => false,
            'message' => 'Role not found',
        ], ResponseInterface::HTTP_NOT_FOUND);

        $m_role->update($id, $data);

        return $this->respondUpdated([
            'success' => true,
            'message' => 'Role updated successfully',
        ], 'Role updated successfully');
    }
}
