<?php

namespace App\Controllers;

$model = new UserModel();
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function attempt()
{
    $session = session();
    $model   = new UserModel();

    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan di database');
    }

    if (!password_verify($password, $user['password'])) {
        return redirect()->back()->with('error', 'Password salah');
    }

    // Set session dengan benar
    $session->set([
        'id'        => $user['id'],       // <- INI WAJIB! supaya user_id tidak NULL
        'email'     => $user['email'],
        'username'  => $user['username'],
        'role'      => $user['role'],
        'logged_in' => true
    ]);

    // Redirect berdasarkan role
    if ($user['role'] === 'admin') {
        return redirect()->to(base_url('admin'));
    } else {
        return redirect()->to(base_url('/'));
    }
}


    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => 'pelanggan'
        ];

        $model->insert($data);

        return redirect()->to('/auth/login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
