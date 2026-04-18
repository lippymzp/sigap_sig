<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile2 extends Controller
{
    public function profil_admin()
    {
        $data = [
            'nama'  => 'Admin',
            'email' => 'admin@gmail.com'
        ];

        return view('gol_a/profil_admin', $data);
    }
}