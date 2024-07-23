<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('admin/dashboard');
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
