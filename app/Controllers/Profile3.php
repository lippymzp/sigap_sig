<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PetugasModel;

class Profile3 extends Controller
{
    /**
     * Mengambil layout dashboard secara dinamis berdasarkan id_jabatan di session
     */
    private function getDashboardLayout()
    {
        $id_jabatan = session()->get('id_jabatan');

        switch ($id_jabatan) {
            case 1:
                return 'layout/dashboard_layout_kepala';   
            case 2:
                return 'layout/dashboard_layout_kader';    
            case 3:
                return 'layout/dashboard_layout_admin';    
            default:
                return 'layout/dashboard_layout_admin'; 
        }
    }

    /**
     * HALAMAN PROFIL USER
     */
    public function profil_kader()
    {
        $id_petugas = session()->get('id_petugas');

        if (empty($id_petugas)) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $model = new PetugasModel();
        $petugas = $model->getProfil($id_petugas);
        $layout_dinamis = $this->getDashboardLayout();

        $data = [
            'petugas' => $petugas,
            'layout'  => $layout_dinamis,
            'menu'    => 'profil',
            'judul'   => 'Profil',
            'title'   => 'Profil'
        ];

        return view('gol_a/profil_kader', $data);
    }

    /**
     * PROSES UPDATE DATA EMAIL & PASSWORD
     */
    public function updateProfil()
    {
        $id_petugas = session()->get('id_petugas');

        if (empty($id_petugas)) {
            return redirect()->to(base_url('login'))->with('error', 'Sesi Anda habis, silakan login ulang.');
        }

        $model = new PetugasModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = [
            'email' => $email
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($model->update($id_petugas, $data)) {
            return redirect()->to(base_url('profil_kader'))->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui database.');
        }
    }

    /**
     * PROSES UPLOAD FOTO PROFIL
     */
    public function uploadFoto()
    {
        $id_petugas = session()->get('id_petugas');

        if (empty($id_petugas)) {
            return redirect()->to(base_url('login'))->with('error', 'Sesi Anda telah berakhir.');
        }

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            
            $db = \Config\Database::connect();
            
            // Menggunakan tabel 'profil' sesuai dengan database kamu
            $builder = $db->table('profil'); 

            // Cek foto lama
            $fotoLama = $builder->where('id_petugas', $id_petugas)->get()->getRowArray();

            // Hapus fisik foto lama di folder jika ada
            if ($fotoLama && !empty($fotoLama['foto_profil'])) {
                $pathFotoLama = FCPATH . 'uploads/profil/' . $fotoLama['foto_profil'];
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama); 
                }
            }

            // Upload foto baru
            $namaBaru = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profil', $namaBaru);

            // Simpan ke database
            if ($fotoLama) {
                // Jika sebelumnya sudah ada, maka Update
                $builder->where('id_petugas', $id_petugas)->update(['foto_profil' => $namaBaru]);
            } else {
                // Jika belum ada sama sekali, maka Insert
                $builder->insert([
                    'id_petugas'  => $id_petugas,
                    'foto_profil' => $namaBaru
                ]);
            }

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto. Pastikan file valid.');
    }

    /**
     * PROSES HAPUS FOTO PROFIL
     */
    public function hapusFoto()
    {
        $id_petugas = session()->get('id_petugas');

        if (empty($id_petugas)) {
            return redirect()->to(base_url('login'))->with('error', 'Sesi Anda telah berakhir.');
        }

        $db = \Config\Database::connect();
        
        // Menggunakan tabel 'profil' sesuai dengan database kamu
        $builder = $db->table('profil'); 

        $foto = $builder->where('id_petugas', $id_petugas)->get()->getRowArray();

        if ($foto && !empty($foto['foto_profil'])) {
            $pathFoto = FCPATH . 'uploads/profil/' . $foto['foto_profil'];

            // Hapus file fisik di server jika ada
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }

            // Update database, jadikan NULL
            $builder->where('id_petugas', $id_petugas)->update([
                'foto_profil' => null
            ]);
            
            return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Foto profil sudah kosong atau tidak ditemukan.');
    }
}