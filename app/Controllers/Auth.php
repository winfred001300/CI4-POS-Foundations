<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (
            $user &&
            ! empty($user['password']) &&
            password_verify($password, $user['password'])
        ) {
            session()->regenerate(true);

            session()->set([
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'username'   => $user['username'],
            ]);

            return redirect()->to(site_url('customers'));
        }

        return redirect()->to(site_url('login'))
            ->withInput()
            ->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login?logged_out=1'));
    }
}
