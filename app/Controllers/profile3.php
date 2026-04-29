<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile3 extends Controller
{
    public function profil_kader()
    {
        $data = [
            'nama'   => 'Kader',
            'email'  => 'kader@gmail.com',

            // WAJIB untuk layout
            'menu'   => 'profil',          // untuk active sidebar
            'judul'  => 'Profil Kader',    // untuk topbar title
            'title'  => 'Profil Kader'     // optional (tab browser)
        ];

        return view('gol_a/profil_kader', $data);
    }
}