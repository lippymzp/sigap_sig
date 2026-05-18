<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function profil_admin()
    {
        $petugas = [
            'nama_petugas' => session()->get('username'),
            'email'        => session()->get('email'),
            'password'     => '123456',
            'foto_profil'  => session()->get('foto')
        ];

        return view('gol_b/profil_admin', [
            'judul'   => 'Profil Admin',
            'menu'    => 'profil',
            'petugas' => $petugas
        ]);
    }
}