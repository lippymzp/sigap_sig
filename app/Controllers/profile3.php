<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class Profile3 extends Controller
{
    // HALAMAN PROFIL
    public function profil_kader()
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
            'judul' => 'Profil Kader',
            'title' => 'Profil Kader'
        ];

        return view('gol_a/profil_kader', $data);
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

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = [
            'email' => $email
        ];

        // kalau password diisi
        if (!empty($password)) {
            $data['password'] = $password;
        }

        $model->update($id_petugas, $data);

        return redirect()->to(base_url('profil_kader'))
            ->with('success', 'Profil berhasil diupdate');
    }
}