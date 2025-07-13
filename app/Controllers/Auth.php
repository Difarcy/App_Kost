<?php
namespace App\Controllers;
use App\Models\AuthModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = new AuthModel();
        $user = $model->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            return redirect()->to('/admin');
        } else {
            session()->setFlashdata('error', 'Username atau password salah!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
} 