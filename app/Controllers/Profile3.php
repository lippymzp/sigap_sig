<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class Profile3 extends Controller
{
    private function getDashboardLayout()
    {
        // Mengambil id_jabatan dari session login petugas
        $id_jabatan = session()->get('id_jabatan');

        // Melakukan mapping layout berdasarkan id_jabatan dari tabel petugas/jabatan
        switch ($id_jabatan) {
            case 1:
                return 'layout/dashboard_layout_kepala';   // id_jabatan 1 -> Admin
            case 2:
                return 'layout/dashboard_layout_kader';   // id_jabatan 2 -> Kader
            case 3:
                return 'layout/dashboard_layout_admin';  // id_jabatan 3 -> Kepala
            default:
                // Fallback jika id_jabatan berupa superadmin (4) atau belum login
                return 'layout/dashboard_layout_admin'; 
        }
    }

    // HALAMAN PROFIL
    public function profil_kader()
    {
        $layout_dinamis = $this->getDashboardLayout();
        $model = new PetugasModel();
        

        // ambil id user login dari session
        $id_petugas = session()->get('id_petugas');

        // ambil data profil
        $petugas = $model->getProfil($id_petugas);

        $data = [
            'petugas' => $petugas,

            // layout
            'layout'   => $layout_dinamis,
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

    // HAPUS FOTO
    public function hapusFoto()
    {
        $id_petugas = session()->get('id_petugas');
        $model = new \App\Models\PetugasModel();

        // Ambil data profil saat ini
        $petugas = $model->getProfil($id_petugas);

        // Pastikan ada file fotonya sebelum dihapus
        if ($petugas && !empty($petugas['foto_profil'])) {
            $pathFoto = ROOTPATH . 'public/uploads/profil/' . $petugas['foto_profil'];

            // Hapus file fisik dari server jika file tersebut ada
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }

            // Update database, kosongkan field foto_profil
            $model->update($id_petugas, [
                'foto_profil' => null // atau sesuaikan dengan struktur database (misal: '')
            ]);
            
            return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Foto profil gagal dihapus atau sudah kosong.');
    }
}