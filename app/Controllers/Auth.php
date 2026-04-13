<?php

namespace App\Controllers;

class Auth extends BaseController
{

    public function login()
    {
        return view('login');
    }

    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if($email == "admin@gmail.com" && $password == "123"){
            return redirect()->to('/');
        }else{
            return "Login gagal";
        }
    }

}