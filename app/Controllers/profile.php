<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile extends Controller
{
    public function profil_kepala()
    {
        $data = [
            'nama'  => 'Admin',
            'email' => 'admin@gmail.com'
        ];

        return view('gol_a/profil_kepala', $data);
    }

    
}
