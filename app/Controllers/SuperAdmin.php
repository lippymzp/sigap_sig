<?php

namespace App\Controllers;
use App\Models\IklanModel;
use App\Models\ProfilSistemModel;
use App\Models\FilosofiLogoModel;
class SuperAdmin extends BaseController
{

protected $profilModel;

    public function __construct()
    {
        // Menginisialisasi Model Profil Sistem
        $this->profilModel = new ProfilSistemModel();
    }

    public function dashboard()
    {
        return view('superadmin/dashboard', [
            'judul' => 'Dashboard',
            'menu' => 'dashboard'
        ]);
    }

    public function iklan()
{
    $model = new IklanModel();

    $data['iklan'] = $model
        ->orderBy('urutan', 'ASC')
        ->findAll();

    $data['judul'] = 'Iklan Portal';
    $data['menu'] = 'iklan';

    return view('superadmin/manajemen_iklan', $data);
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
  public function simpanIklan()
{
    $iklanModel = new IklanModel();

    $gambar = $this->request->getFile('gambar');

    $namaGambar = 'default-banner.png';

    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/iklan', $namaGambar);
    }

    $iklanModel->save([
        'judul'     => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'gambar'    => $namaGambar,
        'status'    => $this->request->getPost('status'),
        'urutan'    => $this->request->getPost('urutan')
    ]);

    return redirect()->to('/superadmin/manajemen-iklan')
                     ->with('success', 'Iklan berhasil disimpan');
}
public function hapusIklan($id)
{
    $model = new IklanModel();

    $iklan = $model->find($id);

    if ($iklan) {
        unlink('uploads/iklan/' . $iklan['gambar']);
        $model->delete($id);
    }

    return redirect()->to('/superadmin/iklan')
        ->with('success', 'Iklan berhasil dihapus');
}
public function updateIklan($id)
{
    $model = new IklanModel();

    $data = [
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'status' => $this->request->getPost('status'),
        'urutan' => $this->request->getPost('urutan')
    ];

    $gambar = $this->request->getFile('gambar');

    if ($gambar && $gambar->isValid()) {
        $nama = $gambar->getRandomName();
        $gambar->move('uploads/iklan', $nama);
        $data['gambar'] = $nama;
    }

    $model->update($id, $data);

    return redirect()->to('/superadmin/iklan')
        ->with('success', 'Iklan berhasil diupdate');
}
public function formTambahIklan()
{
    return view('superadmin/form_tambah_iklan', [
        'title' => 'Tambah Iklan',
        'judul' => 'Iklan Portal',
        'menu'  => 'iklan'
    ]);
}
public function manajemenIklan()
{
    
    $iklanModel = new IklanModel();

    $data['iklan'] = $iklanModel
        ->orderBy('urutan', 'ASC')
        ->findAll();

    $data['title'] = 'Manajemen Iklan';
    $data['judul'] = 'Iklan Portal';
    $data['menu']  = 'iklan';

    return view('superadmin/manajemen_iklan', $data);
}
public function formEditIklan($id)
{
    $iklanModel = new \App\Models\IklanModel();

    $data = [
        'title' => 'Edit Iklan',
        'judul' => 'Edit Iklan',
        'menu'  => 'iklan',
        'iklan' => $iklanModel->find($id)
    ];

    return view('superadmin/edit_iklan', $data);
}

/* ==========================================
       ⚙️ PROFIL SISTEM & FILOSOFI METHODS
       ========================================== */
    
    // HALAMAN UTAMA - MENAMPILKAN HASIL READ-ONLY
    public function profil_sistem()
    {
        $profilModel   = new \App\Models\ProfilSistemModel();
        $filosofiModel = new \App\Models\FilosofiLogoModel();

        // Ambil baris pertama dari tabel profil_sistem
        $dataProfil = $profilModel->first() ?? [];
        $id_profil  = $dataProfil['id_profil_sistem'] ?? 1;

        // Ambil semua filosofi logo yang sesuai dengan id_profil_sistem
        $dataFilosofi = $filosofiModel->where('id_profil_sistem', $id_profil)->findAll();

        $data = [
            'profil'   => $dataProfil,
            'filosofi' => $dataFilosofi, // Dilempar ke view sebagai array multi-dimensi asli
            'judul'    => 'Profil Sistem',
            'menu'     => 'profil'
        ];

        return view('superadmin/hasil_profil_sistem', $data); 
    }

    // HALAMAN FORM EDIT INPUT
  public function edit()
{
    $profilModel   = new \App\Models\ProfilSistemModel();
    $filosofiModel = new \App\Models\FilosofiLogoModel();

    $dataProfil = $profilModel->first() ?? [];
    $id_profil  = $dataProfil['id_profil_sistem'] ?? 1;

    $dataFilosofi = $filosofiModel->where('id_profil_sistem', $id_profil)->findAll();

    $data = [
        'profil'   => $dataProfil,
        'filosofi' => $dataFilosofi,
        'judul'    => 'Edit Profil Sistem',
        'menu'     => 'profil'
    ];

    // 🛠️ PERBAIKAN: Jika nama file fisik Anda di folder Views adalah profil_sistem.php
    return view('superadmin/profil_sistem', $data); 
}

    // PROSES SIMPAN KE DATABASE
    public function update()
    {
        $profilModel   = new \App\Models\ProfilSistemModel();
        $filosofiModel = new \App\Models\FilosofiLogoModel();

        $id_profil = 1; // ID utama profil sistem

        // 🛠️ FIX PEMETAAN: Judul pendek masuk ke 'profil', teks editor panjang masuk ke 'deskripsi_profil'
        $dataProfil = [
            'profil'           => $this->request->getPost('judul_profil'), 
            'deskripsi_profil' => $this->request->getPost('profil'), 
            'tagline'          => $this->request->getPost('tagline'),
            'isi_visi'         => $this->request->getPost('visi'),
            'isi_misi'         => $this->request->getPost('misi'),
        ];

        // Jalur folder upload yang baru (semua masuk sini)
        $folderUpload = 'uploads/profil_sistem';

        // Upload Logo Utama
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $namaLogo = $logo->getRandomName();
            $logo->move($folderUpload, $namaLogo);
            $dataProfil['logo'] = $namaLogo;
        }

        // Upload Maskot
        $maskot = $this->request->getFile('maskot');
        if ($maskot && $maskot->isValid() && !$maskot->hasMoved()) {
            $namaMaskot = $maskot->getRandomName();
            $maskot->move($folderUpload, $namaMaskot);
            $dataProfil['maskot'] = $namaMaskot;
        }

        $profilModel->update($id_profil, $dataProfil);

        // 2. SIMPAN DATA FILOSOFI LOGO KE TABEL TERPISAH
        $judul          = $this->request->getPost('judul_logo');
        $deskripsi      = $this->request->getPost('deskripsi_logo');
        $gambarFiles    = $this->request->getFiles()['gambar_logo'] ?? [];
        $gambarLamaList = $this->request->getPost('gambar_lama') ?? []; 

        // Hapus data lama di tabel filosofi_logo sebelum insert data baru
        $filosofiModel->where('id_profil_sistem', $id_profil)->delete();

        if ($judul) {
            foreach ($judul as $i => $j) {
                if (empty($j)) continue;

                $namaFile = $gambarLamaList[$i] ?? null; 

                // Jika ada file gambar komponen logo baru yang diupload
                if (isset($gambarFiles[$i]) && $gambarFiles[$i]->isValid() && !$gambarFiles[$i]->hasMoved()) {
                    $namaFile = $gambarFiles[$i]->getRandomName();
                    $gambarFiles[$i]->move($folderUpload, $namaFile);
                }

                // Insert data baru ke tabel filosofi_logo
                $filosofiModel->insert([
                    'id_profil_sistem' => $id_profil,
                    'nama_logo'        => $j,
                    'deskripsi_logo'   => $deskripsi[$i] ?? '',
                    'komponen_logo'    => $namaFile 
                ]);
            }
        }

        return redirect()->to('/superadmin/profil_sistem')->with('success', 'Profil dan Filosofi Berhasil Diperbarui');
    }

    /* ==========================================
       🌐 PUBLIC VIEW - TENTANG KAMI
       ========================================== */
    public function tentang_kami()
    {
        $profilModel   = new ProfilSistemModel();
        $filosofiModel = new FilosofiLogoModel();

        // Ambil baris pertama dari tabel profil_sistem
        $dataProfil = $profilModel->first() ?? [];
        $id_profil  = $dataProfil['id_profil_sistem'] ?? 1;

        // Ambil semua filosofi logo yang sesuai dengan id_profil_sistem
        $dataFilosofi = $filosofiModel->where('id_profil_sistem', $id_profil)->findAll();

        $data = [
            'profil'   => $dataProfil,
            'filosofi' => $dataFilosofi
        ];

        // Memanggil file view tentang_kami.php yang Anda buat sebelumnya
        return view('tentang_kami', $data); 
    }
}