<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Kepala extends Controller
{
    public function dashboard()
    {
        $data = [
            'menu' => 'dashboard',
            'judul' => 'Dashboard Kepala',
            'nama_puskesmas' => 'Puskesmas Panti, Jember',
            'total_kasus' => 20,
            'kasus_baru' => 2,
            'wilayah' => 6
        ];

        return view('gol_a/dashboard_kepala', $data);
    }

    public function export()
    {
        $data = [
            'menu' => 'export',
            'judul' => 'Export Data'
        ];

        return view('gol_a/export_kepala', $data);
    }
}