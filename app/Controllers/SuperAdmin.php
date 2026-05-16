<?php

namespace App\Controllers;

class SuperAdmin extends BaseController
{
    public function dashboard()
    {
        return view('superadmin/dashboard', [
            'judul' => 'Dashboard',
            'menu' => 'dashboard'
        ]);
    }

    public function iklan()
    {
        return view('superadmin/manajemen_iklan', [
            'judul' => 'Manajemen Iklan',
            'menu' => 'iklan'
        ]);
    }

    public function admin()
    {
        return view('superadmin/manajemen_admin', [
            'judul' => 'Manajemen Admin',
            'menu' => 'admin'
        ]);
    }

    public function puskesmas()
    {
        return view('superadmin/manajemen_puskesmas', [
            'judul' => 'Manajemen Puskesmas',
            'menu' => 'puskesmas'
        ]);
    }

    public function profil()
    {
        return view('superadmin/profil_sistem', [
            'judul' => 'Profil Sistem',
            'menu' => 'profil'
        ]);
    }
}