<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class Profile2 extends Controller
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

        return view('gol_a/profil_admin', $data);
    }

    // UPLOAD FOTO
    public function uploadFoto()
    {
        $model = new PetugasModel();

        $id_petugas = session()->get('id_petugas');

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $namaFoto = $file->getRandomName();

            $file->move(FCPATH . 'uploads/profil/', $namaFoto);

            $model->saveFoto($id_petugas, $namaFoto);

            return redirect()->to(base_url('profil_admin'))
                ->with('success', 'Foto berhasil diupload');
        }

        return redirect()->to(base_url('profil_admin'))
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

        return redirect()->to(base_url('profil_admin'))
            ->with('success', 'Profil berhasil diupdate');
    }
}