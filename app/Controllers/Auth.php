<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function login_process()
    {
        $m_user = new User();

        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password') ?? '';

        $redirect = $this->request->getGet('redirect') ?? '/';

        $user = $m_user->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        if (!password_verify($pass, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        session()->set('id', $user['id']);
        session()->set('role_id', $user['role_id']);
        session()->set('name', $user['name']);
        session()->set('email', $user['email']);
        session()->set('jenis_kelamin', $user['jenis_kelamin']);

        return redirect()->to($redirect);
    }

    public function logout()
    {
        session()->remove(['id', 'role_id', 'name']);

        session()->destroy();

        return redirect()->to('/login');
    }
}
