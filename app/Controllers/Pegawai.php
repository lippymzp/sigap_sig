<?php

namespace App\Controllers;

use App\Models\PetugasModel;

class Pegawai extends BaseController
{
    protected $petugasModel;

    public function __construct()
    {
        $this->petugasModel = new PetugasModel();
    }

   public function index()
{
    $keyword = $this->request->getGet('keyword');

    $currentPage = $this->request->getVar('page_petugas') 
        ? (int) $this->request->getVar('page_petugas') 
        : 1;

    $builder = $this->petugasModel
        ->where('id_penyakit', 3);

    if ($keyword) {
        $builder->groupStart()
            ->like('nama_petugas', $keyword)
            ->orLike('NIP', $keyword)
            ->orLike('email', $keyword)
        ->groupEnd();
    }

    $data = [
        'title'       => 'Data Pegawai',
        'judul'       => 'Data Pegawai',
        'menu'        => 'pegawai',
        'penyakit'    => 'pneumonia',
        'petugas'     => $builder->paginate(10, 'petugas'),
        'pager'       => $this->petugasModel->pager,
        'keyword'     => $keyword,
        'currentPage' => $currentPage
    ];

    return view('gol_c/data_pegawai', $data);
}

    public function tambah()
    {
        $data = [
            'title'    => 'Tambah Data Pegawai',
            'judul'    => 'Data Pegawai',
            'menu'     => 'pegawai',
            'penyakit' => 'pneumonia'
        ];

        return view('gol_c/tambah_pegawai', $data);
    }

    public function simpan()
    {
        $this->petugasModel->insert([
            'NIP'          => $this->request->getPost('NIP'),
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'id_jabatan'   => $this->request->getPost('id_jabatan'),
            'id_instansi'  => $this->request->getPost('id_instansi'),
            'id_penyakit'  => 3,
            'alamat'       => $this->request->getPost('alamat'),
            'no_telp'      => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'password'     => $this->request->getPost('password'),
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        return redirect()
            ->to(base_url('index.php/pneumonia/pegawai'))
            ->with('success', 'Data berhasil ditambahkan');
    }

public function edit($id)
{
    $petugas = $this->petugasModel->find($id);

    if (!$petugas) {
        return redirect()
            ->to(base_url('index.php/pneumonia/pegawai'))
            ->with('error', 'Data tidak ditemukan');
    }

    $data = [
        'title'    => 'Edit Data Pegawai',
        'judul'    => 'Data Pegawai',
        'menu'     => 'pegawai',
        'penyakit' => 'pneumonia',
        'petugas'  => $petugas
    ];

    return view('gol_c/edit_pegawai', $data);
}

    public function update($id)
    {
        $this->petugasModel->update($id, [
            'NIP'          => $this->request->getPost('NIP'),
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'id_jabatan'   => $this->request->getPost('id_jabatan'),
            'id_instansi'  => $this->request->getPost('id_instansi'),
            'id_penyakit'  => 3,
            'alamat'       => $this->request->getPost('alamat'),
            'no_telp'      => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'password'     => $this->request->getPost('password')
        ]);

        return redirect()
            ->to(base_url('index.php/pneumonia/pegawai'))
            ->with('success', 'Data berhasil diedit');
    }

    public function hapus($id)
    {
        $this->petugasModel->delete($id);

        return redirect()
            ->to(base_url('index.php/pneumonia/pegawai'))
            ->with('success', 'Data berhasil dihapus');
    }
}