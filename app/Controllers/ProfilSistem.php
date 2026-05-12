<?php

namespace App\Controllers;

use App\Models\profil_sistem;

class ProfilSistem extends BaseController
{
    protected $profilModel;

    public function __construct()
    {
        $this->profilModel = new profil_sistem();
    }

    // ================= INDEX =================
    public function index()
    {
        $profil = $this->profilModel->first();

        // ✅ AUTO CREATE DATA JIKA KOSONG
        if (!$profil) {
            $this->profilModel->insert([
                'nama_sistem' => 'SIGAP',
                'definisi'    => 'Belum ada definisi.',
                'isi_visi'    => 'Belum ada visi.',
                'isi_misi'    => 'Belum ada misi.',
            ]);

            $profil = $this->profilModel->first();
        }

        // ✅ Gabungkan data agar tidak tertimpa
        $data = [
            'menu'          => 'profil_sistem',
            'judul'         => 'Profil Sistem',
            'profil_sistem' => $profil
        ];
        
        return view('gol_a/profil_sistem', $data); 
    }

    // ================= EDIT =================
    public function edit()
    {
        $data = [
            'menu'          => 'profil_sistem',
            'judul'         => 'Edit Profil Sistem',
            'profil_sistem' => $this->profilModel->first()
        ];

        return view('gol_a/edit_profil_sistem', $data);
    }

    // ================= UPDATE =================
    public function update()
    {
        $profil = $this->profilModel->first();

        if (!$profil) {
            return redirect()->to('/profil_sistem');
        }

        $id = $profil['id_profil_sistem'];

        // ✅ Hanya mengambil data Definisi, Visi, dan Misi
        $data = [
            'definisi' => $this->request->getPost('definisi'),
            'isi_visi' => $this->request->getPost('isi_visi'),
            'isi_misi' => $this->request->getPost('isi_misi'),
        ];

        $this->profilModel->update($id, $data);

        return redirect()->to('/profil_sistem')->with('success', 'Profil berhasil diupdate');
    }
}