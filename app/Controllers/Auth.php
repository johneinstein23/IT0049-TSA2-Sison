<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('userId') !== null) {
            return redirect()->to(site_url('/'));
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($username === '' || $password === '') {
            return redirect()->back()->withInput()->with('error', 'Enter both your username and password.');
        }

        $user = (new UserModel())->where('username', $username)->first();
        if ($user === null || empty($user['password']) || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'The username or password is incorrect.');
        }

        session()->regenerate(true);
        session()->set([
            'userId' => (int) $user['id'],
            'username' => $user['username'],
            'fullName' => $user['full_name'],
        ]);

        return redirect()->to(site_url('/'))->with('success', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'))->with('success', 'You have been signed out.');
    }
}
