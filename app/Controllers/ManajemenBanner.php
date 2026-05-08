<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ManajemenBanner extends BaseController
{
    public function index()
    {
        return view('gol_a/manajemen_banner');
    }

    public function unggah()
    {
        return view('gol_a/unggah_banner');
    }
}