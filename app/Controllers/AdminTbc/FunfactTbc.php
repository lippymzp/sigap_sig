<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\FunfactTbcModel;

class FunfactTbc extends BaseController
{
    public function index()
    {
        $model = new FunfactTbcModel();

        $status = $this->request->getGet('status') ?? 'Publish';

        $total = $model->countAll();

        $publish = (clone $model)
            ->where('status_funfact', 'Publish')
            ->countAllResults();

        $draft = (clone $model)
            ->where('status_funfact', 'Draft')
            ->countAllResults();

        $arsip = (clone $model)
            ->where('status_funfact', 'Arsip')
            ->countAllResults();

        $funfact = (clone $model)
            ->where('status_funfact', $status)
            ->orderBy('id_funfact', 'DESC')
            ->findAll();

        return view('gol_b/funfact', [
            'menu'    => 'funfact',
            'judul'   => 'Kelola Funfact',
            'total'   => $total,
            'publish' => $publish,
            'draft'   => $draft,
            'arsip'   => $arsip,
            'status'  => $status,
            'funfact' => $funfact
        ]);
    }

    public function create()
    {
        return view('gol_b/admin/funfact/create', [
            'menu'  => 'funfact',
            'judul' => 'Unggah Funfact'
        ]);
    }

    public function simpan()
{
    $model = new FunfactTbcModel();

    $judul = $this->request->getPost('judul');
    $isi   = $this->request->getPost('isi');

    // ✅ VALIDASI (PENTING)
    if (!$judul || !$isi) {
        session()->setFlashdata('error', 'gagal');
        return redirect()->back()->withInput();
    }

    $file = $this->request->getFile('gambar');
    $namaGambar = 'default.jpg';

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaGambar = $file->getRandomName();
        $file->move(FCPATH . 'uploads/funfact/', $namaGambar);
    }

    $status = $this->request->getPost('status');

    // ✅ SIMPAN & AMBIL ID
    $id = $model->insert([
        'id_petugas'        => session()->get('id_petugas') ?? 1,
        'id_penyakit'       => 1,
        'judul_funfact'     => $judul,
        'penulis_funfact'   => $this->request->getPost('penulis'),
        'deskripsi_funfact' => filter_var($isi, FILTER_VALIDATE_URL)
                                ? 'Kutip funfact luar'
                                : $isi,

        'url'               => filter_var($isi, FILTER_VALIDATE_URL)
                                ? $isi
                                : null,

        'gambar_funfact'    => $namaGambar,
        'tanggal_funfact'   => $this->request->getPost('tanggal'),
        'status_funfact'    => $status ?: 'Publish'
    ]);

    // ✅ SIMPAN ID UNTUK POPUP DETAIL
    session()->setFlashdata('last_id', $id);
    session()->setFlashdata('success', 'unggah');

    return redirect()->to('/tbc/funfact');
}
    
public function simpanKutip()
{
    $model = new FunfactTbcModel();

    $judul = $this->request->getPost('judul');
    $link  = $this->request->getPost('link');

    // ✅ VALIDASI
    if (!$judul || !$link) {
        session()->setFlashdata('error', 'gagal');
        return redirect()->back()->withInput();
    }

    $status = $this->request->getPost('status');

    $id = $model->insert([
        'id_petugas'        => session()->get('id_petugas') ?? 1,
        'id_penyakit'       => 1,
        'judul_funfact'     => $judul,
        'deskripsi_funfact' => 'Kutip funfact luar',
        'gambar_funfact'    => 'default.jpg',
        'tanggal_funfact'   => date('Y-m-d'),
        'url'               => $link,
        'status_funfact'    => $status ?: 'Publish'
    ]);

    session()->setFlashdata('last_id', $id);
    session()->setFlashdata('success', 'unggah');

    return redirect()->to('/tbc/funfact');
}

    public function hapus(int $id)
    {
        $model = new FunfactTbcModel();
        $model->delete($id);

        return redirect()->to('/tbc/funfact');
    }

    public function arsip(int $id)
    {
        $model = new FunfactTbcModel();

        $model->update($id, [
            'status_funfact' => 'Draft'
        ]);

        return redirect()->to('/tbc/funfact?status=Draft');
    }

    public function publish(int $id)
    {
        $model = new FunfactTbcModel();

        $model->update($id, [
            'status_funfact' => 'Publish'
        ]);

        return redirect()->to('/tbc/funfact');
    }

    public function edit(int $id)
    {
        $model = new FunfactTbcModel();

        return view('gol_b/admin/funfact/edit', [
            'menu'    => 'funfact',
            'judul'   => 'Edit Funfact',
            'funfact' => $model->find($id)
        ]);
    }

    public function update(int $id)
{
    $model = new FunfactTbcModel();

    $isi = $this->request->getPost('isi');
    $status = $this->request->getPost('status');

    $data = [
        'judul_funfact'     => $this->request->getPost('judul'),
        'penulis_funfact' => $this->request->getPost('penulis'),
        'deskripsi_funfact' => filter_var($isi, FILTER_VALIDATE_URL)
                                ? 'Kutip funfact luar'
                                : $isi,

        'url'               => filter_var($isi, FILTER_VALIDATE_URL)
                                ? $isi
                                : null,

        'tanggal_funfact'   => $this->request->getPost('tanggal'),
        'status_funfact'    => $status ?: 'Publish'
    ];

    $file = $this->request->getFile('gambar');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $nama = $file->getRandomName();
        $file->move(FCPATH . 'uploads/funfact/', $nama);
        $data['gambar_funfact'] = $nama;
    }

    $model->update($id, $data);

    // ✅ TAMBAH NOTIF EDIT
    session()->setFlashdata('success', 'edit');

    return redirect()->to('/tbc/funfact');
}

    public function detail(int $id)
    {
        $model = new FunfactTbcModel();

        return view('gol_b/admin/funfact/detail', [
            'menu'    => 'funfact',
            'judul'   => 'Detail Funfact',
            'funfact' => $model->find($id)
        ]);
    }
}