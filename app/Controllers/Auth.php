<?php namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller {
    public function login() {
        echo view('auth/login');
    }

    public function attempt() {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/');
            }
        }
        return redirect()->back()->with('error', 'Email atau password salah');
    }

    public function register() {
        echo view('auth/register');
    }

    public function store() {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 'pelanggan'
        ];
        $model->insert($data);
        return redirect()->to('/auth/login')->with('success','Registrasi berhasil, silakan login.');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }
}
