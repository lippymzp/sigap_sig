<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile2 extends Controller
{
    public function profil_admin()
    {
        $data = [
            'nama'   => 'Admin',
            'email'  => 'admin@gmail.com',

            // WAJIB untuk layout
            'menu'   => 'profil',          // untuk active sidebar
            'judul'  => 'Profil Admin',    // untuk topbar title
            'title'  => 'Profil Admin'     // optional (tab browser)
        ];

        return view('gol_a/profil_admin', $data);
    }
}