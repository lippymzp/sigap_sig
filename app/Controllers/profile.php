<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile extends Controller
{
    public function profil_kepala()
    {
        $data = [
            'nama'   => 'Kepala',
            'email'  => 'kepala@gmail.com',

            // WAJIB untuk layout
            'menu'   => 'profil',          // untuk active sidebar
            'judul'  => 'Profil Kepala',    // untuk topbar title
            'title'  => 'Profil Kepala'     // optional (tab browser)
        ];

        return view('gol_a/profil_kepala', $data);
    }

    
}
