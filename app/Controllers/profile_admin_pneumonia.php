<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class Profile_admin_pneumonia extends Controller
{
    // HALAMAN PROFIL
    public function profil_admin()
    {
        $model = new PetugasModel();

        // ambil id user login dari session
        $id_petugas = session()->get('id_petugas');

        // ambil data profil
        $petugas = $model->getProfil($id_petugas);

        $data = [
            'petugas' => $petugas,

            // layout
            'menu'  => 'profil',
            'judul' => 'Profil Admin',
            'title' => 'Profil Admin'
        ];

        return view('gol_c/profil_admin', $data);
    }

    // UPLOAD FOTO
    public function uploadFoto()
{
    $file = $this->request->getFile('foto');

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $namaBaru = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/profil', $namaBaru);

        $id_petugas = session()->get('id_petugas');

        $model = new \App\Models\PetugasModel();
        $model->saveFoto($id_petugas, $namaBaru);

        return redirect()->back()
            ->with('success', 'Foto berhasil diupload');
    }

    return redirect()->back()
        ->with('error', 'Upload gagal');
}


    //update
    public function updateProfil()
{
    $model = new PetugasModel();

    $id_petugas = session()->get('id_petugas');

    $password = $this->request->getPost('password');

    $data = [];

    // email tidak diupdate agar tidak bisa diubah
    if (!empty($password)) {
        $data['password'] = $password;
    }

    if (!empty($data)) {
        $model->update($id_petugas, $data);
    }

    return redirect()->to(base_url('pneumonia/profil_admin'))
        ->with('success', 'Profil berhasil diupdate');
}
}