<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        $penyakit = $this->request->getGet('penyakit');

        if ($penyakit) {
            session()->set('penyakit', $penyakit);
        }

        return view('gol_c/auth/login');
    }

    public function prosesLogin()
    {
        $penyakit = $this->request->getPost('penyakit');

        session()->set('penyakit', $penyakit);

        return redirect()->to('/' . $penyakit . '/dashboard');
    }

    public function forgot()
    {
        return view('gol_c/auth/forgot_password');
    }

    public function otp()
    {
        return view('gol_c/auth/otp');
    }

    public function reset()
    {
        return view('gol_c/auth/reset_password');
    }
}