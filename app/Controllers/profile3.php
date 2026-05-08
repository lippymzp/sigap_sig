<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile3 extends Controller
{
    public function profil_kader()
    {
        $data = [
            'nama'   => 'Kader',
            'email'  => 'kader@gmail.com',

        
            'menu'   => 'profil',          // untuk active sidebar
            'judul'  => 'Profil Kader',    // untuk topbar title
            'title'  => 'Profil Kader'     // optional (tab browser)
        ];

        return view('gol_a/profil_kader', $data);
    }

    public function index()
    {
        // Sesuaikan dengan nama session ID Anda saat login (misal: id_petugas / id_user)
        $id_petugas = session()->get('id_petugas'); 

        $db = \Config\Database::connect();
        // Mengambil data dari tabel profil
        $profil = $db->table('profil')->where('id_petugas', $id_petugas)->get()->getRowArray();

        $data = [
            'profil' => $profil // Wajib dioper agar foto tampil di layar
        ];

        // Sesuaikan dengan letak file view profil Anda
        return view('gol_a/profil_kader', $data); 
    }

    // 2. FUNGSI UNTUK MEMPROSES UPLOAD FOTO
    public function update_foto()
    {
        $fileFoto = $this->request->getFile('foto_profil');
        
        // Jika file tidak valid/kosong
        if (!$fileFoto || !$fileFoto->isValid() || $fileFoto->hasMoved()) {
            return redirect()->back()->with('error', 'Gagal mengunggah. Pastikan Anda memilih foto yang valid.');
        }

        // Generate nama file unik
        $namaFotoBaru = $fileFoto->getRandomName();
        
        // Pindahkan ke public/uploads/profil
        $fileFoto->move(FCPATH . 'uploads/profil', $namaFotoBaru);
        
        // Cek ID petugas yang sedang login
        $id_petugas = session()->get('id_petugas'); 
        
        $db = \Config\Database::connect();
        $tabelProfil = $db->table('profil');
        
        // Cek apakah user ini sudah punya record di tabel profil
        $cekData = $tabelProfil->where('id_petugas', $id_petugas)->get()->getRowArray();
        
        if ($cekData) {
            // Jika sudah ada: HAPUS foto lama dari folder (agar memori tidak penuh), lalu UPDATE
            if (!empty($cekData['foto_profil']) && file_exists(FCPATH . 'uploads/profil/' . $cekData['foto_profil'])) {
                unlink(FCPATH . 'uploads/profil/' . $cekData['foto_profil']);
            }
            $tabelProfil->where('id_petugas', $id_petugas)->update([
                'foto_profil' => $namaFotoBaru
            ]);
        } else {
            // Jika belum ada: INSERT data baru ke tabel profil
            $tabelProfil->insert([
                'id_petugas'  => $id_petugas,
                'foto_profil' => $namaFotoBaru
            ]);
        }
        
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // 3. FUNGSI UPDATE SANDI
    public function update_sandi()
    {
        // Logika update sandi Anda...
    }
}