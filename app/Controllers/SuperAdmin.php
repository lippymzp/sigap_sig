<?php

namespace App\Controllers;

use App\Models\IklanModel;
use App\Models\ProfilSistemModel;
use App\Models\FilosofiLogoModel;

use App\Models\SuperAdmin as SuperAdminModel;




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



    //Manajemen Puskesmas
    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('manajemen_puskesmas');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $builder->groupStart()
                ->like('nama_puskesmas', $keyword)
                ->orLike('kecamatan', $keyword)
                ->orLike('alamat', $keyword)
                ->orLike('no_telpon_puskesmas', $keyword)
                ->groupEnd();
        }

        $builder->orderBy(
            'id_manajemen_puskesmas',
            'ASC'
        );

        $perPage = 5;
        $users = $builder->get()->getResultArray();
        $pager = \Config\Services::pager();
        $totalData = count($users);
        $totalPage = ceil($totalData / $perPage);
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $users = array_slice(
            $users,
            $offset,
            $perPage
        );

        $data = [
            'users'        => $users,
            'pager'        => $pager,
            'currentPage'  => $currentPage,
            'perPage'      => $perPage,
            'keyword'      => $keyword,
            'menu'         => 'puskesmas',
            'totalData'    => $totalData,
            'totalPage'    => $totalPage
        ];

        return view(
            'superadmin/manajemen_puskesmas',
            $data
        );
    }

    public function puskesmas()
    {
        $db = \Config\Database::connect();

        $builder =
            $db->table('manajemen_puskesmas');
        // SEARCH
        $keyword =
            $this->request->getVar('keyword');
        if ($keyword) {
            $builder->groupStart()
                ->like('nama_puskesmas', $keyword)
                ->orLike('kecamatan', $keyword)
                ->orLike('alamat', $keyword)
                ->groupEnd();
        }
        $builder->orderBy(
            'id_manajemen_puskesmas',
            'DESC'
        );

        // PAGINATION
        $perPage = 5;
        $currentPage =
            $this->request->getVar('page') ?? 1;
        $totalData =
            $builder->countAllResults(false);
        $users = $builder
            ->limit(
                $perPage,
                ($currentPage - 1) * $perPage
            )
            ->get()
            ->getResultArray();

        $data = [
            'users' => $users,
            'currentPage' =>
            $currentPage,
            'perPage' =>
            $perPage,
            'totalData' =>
            $totalData,
            'totalPage' =>
            ceil($totalData / $perPage),
            'keyword' =>
            $keyword,
            'menu' =>
            'puskesmas'
        ];

        return view(
            'superadmin/manajemen_puskesmas',
            $data
        );
    }

    public function store()
    {
        $userModel = new SuperAdminModel(); // atau model usermu

        $userModel->save([
            'role'      => $this->request->getPost('role'),
            'puskesmas' => $this->request->getPost('puskesmas'),
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/superadmin-user')->with('success', 'User berhasil ditambahkan');
    }

    public function create()
    {
        $db = \Config\Database::connect();

        $data = [
            'menu' => 'puskesmas'
        ];
        return view('superadmin/create_pkm', $data);
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
    // ===========================
    // Superadmin Manajemen Admin
    // ===========================
    public function manajemen_admin()
    {
        $db = \Config\Database::connect();

        $keyword = $this->request->getGet('keyword');

        $builder = $db->table('petugas p');

        $builder->select('
        p.*,
        i.nama_instansi
    ');

        $builder->join(
            'instansi i',
            'i.id_instansi = p.id_instansi',
            'left'
        );

        // admin + superadmin
        $builder->whereIn('p.id_jabatan', [3, 4]);

        if ($keyword) {

            $builder->groupStart();

            $builder->like(
                'p.nama_petugas',
                $keyword
            );

            $builder->orLike(
                'p.NIP',
                $keyword
            );

            $builder->groupEnd();
        }

        $petugas = $builder
            ->orderBy('p.id_petugas', 'DESC')
            ->get()
            ->getResultArray();

        return view(
            'superadmin/manajemen_admin',
            [
                'petugas' => $petugas,
                'keyword' => $keyword,

                'menu' => 'manajemen_admin',

                'judul' => 'Manajemen Admin'
            ]
        );
    }

    public function manajemen_admin_tambah()
    {
        $db = \Config\Database::connect();

        $penyakit = $db
            ->table('penyakit')
            ->get()
            ->getResultArray();

        return view(
            'superadmin/manajemen_admin_tambah',
            [
                'menu' => 'manajemen_admin',

                'judul' => 'Tambah Admin',

                'penyakit' => $penyakit
            ]
        );
    }

    public function manajemen_admin_simpan()
    {
        $db = \Config\Database::connect();

        $db->table('petugas')->insert([

            'nama_petugas' =>
            $this->request->getPost('nama_petugas'),

            'NIP' =>
            $this->request->getPost('NIP'),

            'id_jabatan' =>
            $this->request->getPost('id_jabatan'),

            'id_instansi' =>
            $this->request->getPost('id_instansi'),

            'id_penyakit' => 
            $this->request->getPost('id_penyakit'),

            'email' =>
            $this->request->getPost('email'),

            'no_telp' =>
            $this->request->getPost('no_telp'),

            'alamat' =>
            $this->request->getPost('alamat'),

            'password' =>
            $this->request->getPost('password')
        ]);

        return redirect()
            ->to(
                base_url(
                    'index.php/superadmin/manajemen_admin'
                )
            )
            ->with(
                'success',
                'Data admin berhasil ditambahkan'
            );
    }

    public function manajemen_admin_edit($id)
    {
        $db = \Config\Database::connect();

        $petugas = $db
            ->table('petugas')
            ->where('id_petugas', $id)
            ->get()
            ->getRowArray();

        $penyakit = $db->table('penyakit')->get()->getResultArray();

        return view(
            'superadmin/manajemen_admin_edit',
            [
                'petugas' => $petugas,

                'menu' => 'manajemen_admin',

                'judul' => 'Edit Admin',

                'penyakit' => $penyakit
            ]
        );
    }

    public function manajemen_admin_update($id)
    {
        $db = \Config\Database::connect();

        $data = [

            'nama_petugas' =>
            $this->request->getPost('nama_petugas'),

            'NIP' =>
            $this->request->getPost('NIP'),

            'id_jabatan' =>
            $this->request->getPost('id_jabatan'),

            'id_instansi' =>
            $this->request->getPost('id_instansi'),

            'email' =>
            $this->request->getPost('email'),

            'alamat' =>
            $this->request->getPost('alamat'),

            'no_telp' =>
            $this->request->getPost('no_telp'),

            'id_penyakit' =>
            $this->request->getPost('id_penyakit'),
        ];

        // password optional
        if ($this->request->getPost('password')) {

            $data['password'] =
                $this->request->getPost('password');
        }

        $db->table('petugas')
            ->where('id_petugas', $id)
            ->update($data);

        return redirect()
            ->to(
                base_url(
                    'index.php/superadmin/manajemen_admin'
                )
            )
            ->with(
                'success',
                'Data admin berhasil diupdate'
            );
    }

    public function manajemen_admin_hapus($id)
    {
        $db = \Config\Database::connect();

        $db->table('petugas')
            ->where('id_petugas', $id)
            ->delete();

        return redirect()
            ->to(
                base_url(
                    'index.php/superadmin/manajemen_admin'
                )
            )
            ->with(
                'success',
                'Data admin berhasil dihapus'
            );
    }

    public function storePuskesmas()
    {
        $db = \Config\Database::connect();
        $model = new \App\Models\SuperAdmin();

        // Ambil data dari form
        $nama_puskesmas = $this->request->getPost('nama_puskesmas');
        $kecamatan      = $this->request->getPost('kecamatan');
        $alamat         = $this->request->getPost('alamat');
        $email          = $this->request->getPost('email_puskesmas');
        $latitude       = $this->request->getPost('latitude');
        $longitude      = $this->request->getPost('longitude');
        $no_telpon      = '+62' . $this->request->getPost('no_telpon_puskesmas');

        //$kelurahanArray = array_filter($this->request->getPost('kelurahan'));
        $kelurahanArray = array_filter($this->request->getPost('kelurahan') ?? []);
        //$posyanduArray  = $this->request->getPost('posyandu');
        $posyanduArray = $this->request->getPost('posyandu') ?? [];
        // Simpan data Puskesmas
        $db->table('manajemen_puskesmas')->insert([
            'nama_puskesmas'    => $nama_puskesmas,
            'kecamatan'         => $kecamatan,
            'alamat'            => $alamat,
            'kode_pos'          => $this->request->getPost('kode_pos'),
            'email_puskesmas'   => $email,
            'latitude'          => $latitude,
            'longitude'         => $longitude,
            'no_telpon_puskesmas' => $no_telpon,
            'created_at'        => date('Y-m-d H:i:s'),
            'update_at'         => date('Y-m-d H:i:s')
        ]);

        $puskesmasId = $db->insertID(); // ID Puskesmas yang baru
        foreach ($kelurahanArray as $i => $kel) {

            // cek apakah kelurahan sudah ada
            $cekKel = $db->table('kelurahan')
                ->where('nama_kelurahan', $kel)
                ->where('id_manajemen_puskesmas', $puskesmasId)
                ->get()
                ->getRowArray();

            // kalau belum ada → insert
            if (!$cekKel) {

                $db->table('kelurahan')->insert([
                    'id_manajemen_puskesmas' => $puskesmasId,
                    'nama_kelurahan' => $kel
                ]);

                $kelurahanId = $db->insertID();
            } else {
                // kalau sudah ada → pakai ID lama
                $kelurahanId = $cekKel['id_kelurahan'];
            }

            // $kelurahanId = $db->insertID();
            if (isset($posyanduArray[$i]) && count($posyanduArray[$i]) > 0) {
                foreach ($posyanduArray[$i] as $pos) {
                    if (trim($pos) !== '') {
                        $db->table('kelurahan_posyandu')->insert([
                            'id_manajemen_puskesmas' => $puskesmasId,
                            'id_kelurahan' => $kelurahanId,
                            'nama_posyandu' => $pos,
                            'created_at' => date('Y-m-d H:i:s'),
                            'update_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            } else {
                // simpan kelurahan walau tanpa posyandu
                $db->table('kelurahan_posyandu')->insert([
                    'id_manajemen_puskesmas' => $puskesmasId,
                    'id_kelurahan' => $kelurahanId,
                    'nama_posyandu' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->to('/superadmin/puskesmas')
            ->with('success', 'Puskesmas berhasil ditambahkan')
            ->with('id_puskesmas', $puskesmasId);
    }

    public function getKodePos($id_kecamatan)
    {
        $db = \Config\Database::connect();
        $kecamatan = $db->table('kecamatan')->where('id_kecamatan', $id_kecamatan)->get()->getRowArray();

        // kirim kode pos sebagai JSON
        return $this->response->setJSON(['kode_pos' => $kecamatan['kode_pos'] ?? '']);
    }

    public function viewPkm($id)
    {
        $db = \Config\Database::connect();

        $puskesmas = $db->table('manajemen_puskesmas')
            ->where('id_manajemen_puskesmas', $id)
            ->get()
            ->getRowArray();

        $posyanduData = $db->table('kelurahan k')
            ->select('
            k.id_kelurahan,
            k.nama_kelurahan,
            kp.nama_posyandu
        ')

            ->join(
                'kelurahan_posyandu kp',
                'kp.id_kelurahan = k.id_kelurahan',
                'left'
            )

            ->where(
                'k.id_manajemen_puskesmas',
                $id
            )

            ->get()
            ->getResultArray();

        $kelurahanData = [];

        foreach ($posyanduData as $row) {
            $idKel = $row['id_kelurahan'];

            if (!isset($kelurahanData[$idKel])) {
                $kelurahanData[$idKel] = [
                    'id_kelurahan'   => $idKel,
                    'nama_kelurahan' =>
                    $row['nama_kelurahan'],
                    'posyandu'       => []
                ];
            }

            if (
                isset($row['nama_posyandu']) &&
                trim($row['nama_posyandu']) != ''
            ) {
                $kelurahanData[$idKel]['posyandu'][] =
                    $row['nama_posyandu'];
            }
        }

        $data = [
            'menu' => 'puskesmas',
            'puskesmas' => $puskesmas,
            'instansiList' => $db->table('instansi')
                ->like('nama_instansi', 'Puskesmas')
                ->get()
                ->getResultArray(),
            'kelurahanData' =>
            array_values($kelurahanData)
        ];

        return view(
            'superadmin/view_pkm',
            $data
        );
    }

    public function editPkm($id)
    {
        $db = \Config\Database::connect();

        $puskesmas = $db->table('manajemen_puskesmas')
            ->where('id_manajemen_puskesmas', $id)
            ->get()
            ->getRowArray();

        $posyanduData = $db->table('kelurahan_posyandu kp')
            ->select('kp.*, k.nama_kelurahan')
            ->join('kelurahan k', 'k.id_kelurahan = kp.id_kelurahan')
            ->where('kp.id_manajemen_puskesmas', $id)
            ->get()
            ->getResultArray();

        // grouping data
        $kelurahanData = [];
        foreach ($posyanduData as $row) {
            $idKel = $row['id_kelurahan'];

            if (!isset($kelurahanData[$idKel])) {
                $kelurahanData[$idKel] = [
                    'id_kelurahan' => $idKel,
                    'nama_kelurahan' => $row['nama_kelurahan'],
                    'posyandu' => []
                ];
            }

            $kelurahanData[$idKel]['posyandu'][] =
                $row['nama_posyandu'];
        }

        $data = [
            'menu' => 'puskesmas',
            'puskesmas' => $puskesmas,
            'kelurahanList' => $db->table('kelurahan')
                ->get()
                ->getResultArray(),
            'kelurahanData' =>
            array_values($kelurahanData)
        ];

        return view('superadmin/edit_pkm', $data);
    }

    public function updatePkm($id)
    {
        $db = \Config\Database::connect();

        $puskesmasId = $id;

        $nama_puskesmas = $this->request->getPost('nama_puskesmas');
        $kecamatan = $this->request->getPost('kecamatan');
        $alamat    = $this->request->getPost('alamat');
        $kode_pos  = $this->request->getPost('kode_pos');
        $email     = $this->request->getPost('email_puskesmas');
        $latitude  = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');
        $no_telpon = '+62' .
            $this->request->getPost('no_telpon_puskesmas');

        $db->table('manajemen_puskesmas')
            ->where('id_manajemen_puskesmas', $id)
            ->update([
                'nama_puskesmas'      => $nama_puskesmas,
                'kecamatan'           => $kecamatan,
                'alamat'              => $alamat,
                'kode_pos'            => $kode_pos,
                'email_puskesmas'     => $email,
                'latitude'            => $latitude,
                'longitude'           => $longitude,
                'no_telpon_puskesmas' => $no_telpon,
                'update_at'           => date('Y-m-d H:i:s')
            ]);

        $db->table('kelurahan_posyandu')
            ->where('id_manajemen_puskesmas', $id)
            ->delete();

        $kelurahanArray =
            array_filter(
                $this->request->getPost('kelurahan') ?? []
            );

        $posyanduArray =
            $this->request->getPost('posyandu') ?? [];

        foreach ($kelurahanArray as $i => $kel) {

            $cekKel = $db->table('kelurahan')
                ->where('nama_kelurahan', $kel)
                ->where('id_manajemen_puskesmas', $puskesmasId)
                ->get()
                ->getRowArray();

            if (!$cekKel) {

                $db->table('kelurahan')->insert([

                    'id_manajemen_puskesmas'
                    => $puskesmasId,

                    'nama_kelurahan'
                    => $kel

                ]);
                $kelurahanId = $db->insertID();
            } else {
                $kelurahanId =
                    $cekKel['id_kelurahan'];
            }

            if (
                isset($posyanduArray[$i]) &&
                count($posyanduArray[$i]) > 0
            ) {
                foreach ($posyanduArray[$i] as $pos) {
                    if (trim($pos) == '') {
                        continue;
                    }

                    $db->table('kelurahan_posyandu')
                        ->insert([
                            'id_manajemen_puskesmas'
                            => $puskesmasId,
                            'id_kelurahan'
                            => $kelurahanId,
                            'nama_posyandu'
                            => $pos,
                            'created_at'
                            => date('Y-m-d H:i:s'),
                            'update_at'
                            => date('Y-m-d H:i:s')
                        ]);
                }
            }
        }

        return redirect()
            ->to('/superadmin/puskesmas/edit/' . $id)
            ->with('success_update', true)
            ->with('id_puskesmas', $id);
    }

    public function deletePkm($id)
    {
        $db = \Config\Database::connect();
        $kelurahan = $db->table('kelurahan_posyandu')
            ->select('id_kelurahan')
            ->where('id_manajemen_puskesmas', $id)
            ->get()
            ->getResultArray();

        $db->table('kelurahan_posyandu')
            ->where('id_manajemen_puskesmas', $id)
            ->delete();

        foreach ($kelurahan as $k) {
            // cek apakah kelurahan masih dipakai
            $cek = $db->table('kelurahan_posyandu')
                ->where('id_kelurahan', $k['id_kelurahan'])
                ->countAllResults();

            // kalau sudah tidak dipakai
            if ($cek == 0) {

                $db->table('kelurahan')
                    ->where('id_kelurahan', $k['id_kelurahan'])
                    ->delete();
            }
        }

        $db->table('manajemen_puskesmas')
            ->where('id_manajemen_puskesmas', $id)
            ->delete();

        return redirect()->to('/superadmin/puskesmas')
            ->with('success_delete', true);
    }
}
