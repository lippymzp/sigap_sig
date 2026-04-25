<?php

namespace App\Controllers;
use App\Models\LoginModel;

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
        $model = new \App\Models\LoginModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $penyakit_login = session()->get('penyakit');

        $user = $model->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }

        if ($password != $user['password']) {
            return redirect()->back()->with('error', 'Password salah!');
        }

        $penyakitModel = new \App\Models\PenyakitModel();
        $penyakitDB = $penyakitModel->find($user['id_penyakit']);

        if (
            !$penyakitDB ||
            strtolower(trim($penyakitDB['nama_penyakit'])) != strtolower(trim($penyakit_login))
        ) {
            return redirect()->back()->with('error', 'Akun tidak punya akses ke halaman ini!');
        }

        // lanjut OTP
        $otp = rand(100000, 999999);

        session()->set([
            'temp_user' => $user['id_user'],
            'otp_code' => $otp,
            'otp_expired' => time() + 300
        ]);

        $sent = $this->sendOtpEmail($email, $otp);

        if (!$sent) {
            return redirect()->back()->with('error', 'OTP login gagal dikirim!');
        }

        return redirect()->to('/otp-login');
    }

    public function forgot()
    {
        return view('gol_c/auth/forgot_password');
    }

    public function prosesForgot()
    {
        $model = new LoginModel();

        $email = $this->request->getPost('email');
        $user = $model->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }

        $otp = rand(100000, 999999);

        session()->set([
            'reset_email' => $email,
            'reset_otp' => $otp,
            'reset_otp_expired' => time() + 300
        ]);

        $sent = $this->sendOtpEmail($email, $otp);

        if (!$sent) {
            return redirect()->back()->with('error', 'Email gagal dikirim!');
        }

        return redirect()->to('/otp-reset');
    }

    public function logout()
    {
    session()->destroy();

    return redirect()->to('/'); // ke home.php
    }

    public function otpLogin()
    {
        return view('gol_c/auth/otp_login');
    }

    public function verifyOtpLogin()
    {
        $otp = $this->request->getPost('otp');

        $code = session()->get('otp_code');
        $expired = session()->get('otp_expired');

        if (!$code || !$expired) {
            return redirect()->back()->with('error', 'OTP tidak valid!');
        }

        if (time() > $expired) {
            return redirect()->back()->with('error', 'OTP expired!');
        }

        if ($otp != $code) {
            return redirect()->back()->with('error', 'OTP salah!');
        }

        // AMBIL USER DARI DB
        $model = new \App\Models\LoginModel();
        $user = $model->find(session()->get('temp_user'));

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan!');
        }

        // SET SESSION LOGIN FINAL
        session()->set([
            'logged_in' => true,
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'id_penyakit' => $user['id_penyakit']
        ]);

        // HAPUS SESSION OTP
        session()->remove(['otp_code','otp_expired','temp_user']);

        $penyakitModel = new \App\Models\PenyakitModel();
        $penyakit = $penyakitModel->find($user['id_penyakit']);

        if (!$penyakit) {
            return redirect()->to('/login')->with('error', 'Penyakit tidak ditemukan!');
        }

        return redirect()->to('/' . strtolower($penyakit['nama_penyakit']) . '/dashboard');
    }

    public function otpReset()
    {
        return view('gol_c/auth/otp_reset');
    }

    public function verifyOtpReset()
    {
        $otp = $this->request->getPost('otp');

        $code = session()->get('reset_otp');
        $expired = session()->get('reset_otp_expired');

        if (!$code || !$expired) {
            return redirect()->back()->with('error', 'OTP tidak valid!');
        }

        if (time() > $expired) {
            return redirect()->back()->with('error', 'OTP expired!');
        }

        if ($otp != $code) {
            return redirect()->back()->with('error', 'OTP salah!');
        }

        return redirect()->to('/reset');
    }

    public function reset()
    {
        return view('gol_c/auth/reset_password');
    }

    public function prosesReset()
    {
        $model = new \App\Models\LoginModel();

        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');
        $email = session()->get('reset_email');

        if (!$email) {
            return redirect()->to('/login');
        }

        if ($password != $password_confirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak sama!');
        }

        // update password
        $model->where('email', $email)
            ->set(['password' => $password])
            ->update();

        // ambil penyakit dari DB
        $user = $model->where('email', $email)->first();
        $penyakitModel = new \App\Models\PenyakitModel();
        $p = $penyakitModel->find($user['id_penyakit']);

        $penyakit = $p['nama_penyakit'];

        // bersihin session reset
        session()->remove('reset_email');

        return redirect()->to('/login?penyakit=' . $penyakit)
            ->with('success', 'Password berhasil diubah!');
    }

    private function sendOtpEmail($email, $otp)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('lutfirizalul06@gmail.com', 'SIGAP');
        $emailService->setSubject('OTP Code');
        $emailService->setMessage("OTP kamu: $otp");

        if (!$emailService->send(false)) {
            echo "<pre>";
            print_r($emailService->printDebugger(['headers','subject','body']));
            die;
        }

        return true;
    }

}