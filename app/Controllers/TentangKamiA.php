<?php

namespace App\Controllers;

use App\Models\profil_sistem;

class TentangKamiA extends BaseController
{
   public function tentangkamiDBD()
    {
        $model = new profil_sistem();

        $data['profil'] = $model->first();

        return view('gol_a/tentang', $data);
    }
}