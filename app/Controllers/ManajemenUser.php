<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\JabatanModel;
use App\Models\InstansiModel;

class ManajemenUser extends BaseController
{
    protected $petugas;
    protected $jabatan;
    protected $instansi;

    public function __construct()
    {
        $this->petugas = new PetugasModel();
        $this->jabatan = new JabatanModel();
        $this->instansi = new InstansiModel();
    }

    // ================= LIST =================
    public function index()
{
    $keyword = $this->request->getGet('keyword');
    $jabatan = $this->request->getGet('jabatan');

    $perPage = 8;

    // QUERY
    $this->petugas
        ->select('petugas.*, jabatan.nama_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan = petugas.id_jabatan');

    // SEARCH
    if (!empty($keyword)) {

        $this->petugas->groupStart()
            ->like('nama_petugas', $keyword)
            ->orLike('email', $keyword)
            ->orLike('NIP', $keyword)
        ->groupEnd();
    }

    // FILTER
    if (!empty($jabatan)) {

        $this->petugas->where('petugas.id_jabatan', $jabatan);
    }

    // TOTAL DATA
    $total = $this->petugas->countAllResults(false);

    // PAGINATION
    $petugas = $this->petugas->paginate($perPage, 'default');

    // PAGER
    $pager = $this->petugas->pager;

    // HALAMAN SEKARANG
    $currentPage = $pager->getCurrentPage('default');

    // NOMOR AWAL
    $start = ($currentPage - 1) * $perPage + 1;

    // NOMOR AKHIR
    $end = min($start + $perPage - 1, $total);

    $data = [

        'petugas' => $petugas,
        'pager' => $pager,
        'total' => $total,
        'start' => $start,
        'end' => $end,

        'jabatan_list' => $this->jabatan->findAll(),

        'keyword' => $keyword,
        'selected_jabatan' => $jabatan,

        'menu' => 'manajemen_user',
        'judul' => 'Manajemen User'
    ];

    return view('gol_a/manajemen_user/index', $data);
}

    // ================= FORM TAMBAH & EDIT =================
    public function form($id = null, $mode = 'tambah')
    {
        $data['jabatan'] = $this->jabatan->findAll();
        $data['instansi'] = $this->instansi->findAll();

       $data = [
        'jabatan' => $this->jabatan->findAll(),
        'instansi' => $this->instansi->findAll(),
        'mode' => $mode,
        'menu' => 'manajemen_user',
        'judul' => 'Manajemen User'
    ];

    if ($id) {
        $data['user'] = $this->petugas->find($id);
    }

    return view('gol_a/manajemen_user/form', $data);



        return view('gol_a/manajemen_user/form', $data);
    }

    // ================= SIMPAN =================
    public function simpan()
    {
        // validasi password
        if (
            $this->request->getPost('password') !=
            $this->request->getPost('konfirmasi_password')
        ) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Konfirmasi password tidak sama.');
        }

        $this->petugas->save([

            'NIP'           => $this->request->getPost('nip'),
            'nama_petugas'  => $this->request->getPost('nama_petugas'),

            'id_jabatan'    => $this->request->getPost('id_jabatan'),

            'id_instansi'   => $this->request->getPost('id_instansi'),

            // otomatis
            'id_penyakit'   => 1,

            'no_telp'       => $this->request->getPost('no_telp'),

            'email'         => $this->request->getPost('email'),

            'password'      => $this->request->getPost('p'),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/manajemen-user')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    // ================= UPDATE =================
    public function update($id)
    {
        // cek password jika diisi
        if ($this->request->getPost('password')) {

            if (
                $this->request->getPost('password') !=
                $this->request->getPost('konfirmasi_password')
            ) {

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Konfirmasi password tidak sama.');
            }
        }

        $data = [

            'id_petugas'    => $id,

            'NIP'           => $this->request->getPost('nip'),

            'nama_petugas'  => $this->request->getPost('nama_petugas'),

            'id_jabatan'    => $this->request->getPost('id_jabatan'),

            'id_instansi'   => $this->request->getPost('id_instansi'),

            // otomatis tetap 1
            'id_penyakit'   => 1,

            'no_telp'       => $this->request->getPost('no_telp'),

            'email'         => $this->request->getPost('email'),
        ];

        // update password kalau diisi
        if ($this->request->getPost('password')) {

            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->petugas->save($data);

        return redirect()->to('/manajemen-user')
            ->with('success', 'Data berhasil diupdate.');
    }

    // ================= HAPUS =================
    public function hapus($id)
    {
        $db = \Config\Database::connect();

        // cek apakah petugas dipakai di tabel pasien
        $jumlahPasien = $db->table('pasien')
            ->where('id_petugas', $id)
            ->countAllResults();

        // kalau masih dipakai
        if ($jumlahPasien > 0) {

            return redirect()->to('/manajemen-user')
                ->with('error', 'Data petugas tidak bisa dihapus karena masih digunakan pada data pasien.');
        }

        // hapus jika aman
        $this->petugas->delete($id);

        return redirect()->to('/manajemen-user')
            ->with('success', 'Data berhasil dihapus.');
}

    // ================= DETAIL =================
    public function view($id)
    {
        $data['user'] = $this->petugas
            ->select('petugas.*, jabatan.nama_jabatan')
            ->join('jabatan', 'jabatan.id_jabatan = petugas.id_jabatan')
            ->find($id);

        return view('gol_a/manajemen_user/view', $data);
    }
}