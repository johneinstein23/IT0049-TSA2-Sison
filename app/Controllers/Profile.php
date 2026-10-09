<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $user = $userModel->orderBy('id', 'ASC')->first();

        return view('pages/profile', ['user' => $user]);
    }
}
