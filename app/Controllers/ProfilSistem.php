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
                'alamat'      => '-',
                'email'       => '-',
                'instagram'   => '-',
            ]);

            $profil = $this->profilModel->first();
        }

        $data['profil_sistem'] = $profil;
        $data = [
        'menu' => 'profil_sistem',
        'judul' => 'Profil Sistem',
            ];
        return view('gol_a/profil_sistem', $data); 
    }

    // ================= EDIT =================
    public function edit()
    {
        $data['profil'] = $this->profilModel->first();

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

        $data = [
            'nama_sistem' => $this->request->getPost('nama_sistem'),
            'alamat'      => $this->request->getPost('alamat'),
            'email'       => $this->request->getPost('email'),
            'instagram'   => $this->request->getPost('instagram'),
        ];

        // upload logo
        $file = $this->request->getFile('logo');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $namaLogo = $file->getRandomName();
            $file->move('uploads/logo', $namaLogo);

            $data['logo'] = $namaLogo;
        }

        $this->profilModel->update($id, $data);

        return redirect()->to('/profil_sistem')
            ->with('success', 'Profil berhasil diupdate');
    }
}