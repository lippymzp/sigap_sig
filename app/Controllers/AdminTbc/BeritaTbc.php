<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\BeritaTbcModel;

class BeritaTbc extends BaseController
{
    public function index()
    {
        $model = new BeritaTbcModel();

        $status = $this->request->getGet('status') ?? 'Publish';

        $total   = $model->countAll();

        $publish = $model->where('status_berita', 'Publish')->countAllResults();
        $draft   = $model->where('status_berita', 'Draft')->countAllResults();
        $arsip   = $model->where('status_berita', 'Arsip')->countAllResults();

        $berita = $model->where('status_berita', $status)
                        ->orderBy('id_berita', 'DESC')
                        ->findAll();

        return view('gol_b/berita', [
            'menu'    => 'berita',
            'judul'   => 'Kelola Berita',
            'total'   => $total,
            'publish' => $publish,
            'draft'   => $draft,
            'arsip'   => $arsip,
            'status'  => $status,
            'berita'  => $berita
        ]);
    }

    public function create()
    {
        return view('gol_b/admin/berita/create', [
            'menu'  => 'berita',
            'judul' => 'Unggah Berita'
        ]);
    }

  public function simpan()
{
    $model = new BeritaTbcModel();

    $file = $this->request->getFile('gambar');
    $namaGambar = 'default.jpg';

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaGambar = $file->getRandomName();
        $file->move('uploads/berita/', $namaGambar);
    }

    $isi = $this->request->getPost('isi');

    if (is_array($isi)) {
        $isi = implode('', $isi);
    }

    // 🔥 SIMPAN & AMBIL ID
    $id = $model->insert([
        'id_petugas'        => session()->get('id_petugas') ?? 1,
        'id_penyakit'       => 1,
        'judul_berita'      => $this->request->getPost('judul'),

        'deskripsi_berita'  => filter_var($isi, FILTER_VALIDATE_URL)
                                ? 'Kutip berita luar'
                                : $isi,

        'url_berita'        => filter_var($isi, FILTER_VALIDATE_URL) ? $isi : null,
        'gambar_berita'     => $namaGambar,
        'tanggal_berita'    => $this->request->getPost('tanggal'),
        'status_berita'     => $this->request->getPost('status') ?: 'Publish'
    ]);

    // 🔥 INI YANG KAMU BELUM ADA
    session()->setFlashdata('success', true);
    session()->setFlashdata('last_id', $id);

    return redirect()->to('/tbc/berita');
}

   public function simpanKutip()
{
    $model = new BeritaTbcModel();

    // 🔥 TAMBAH INI
    $isi = $this->request->getPost('isi') ?? $this->request->getPost('link');
    $namaGambar = 'default.jpg';

    $id = $model->insert([
        'id_petugas'        => session()->get('id_petugas') ?? 1,
        'id_penyakit'       => 1,
        'judul_berita'      => $this->request->getPost('judul'),

        'deskripsi_berita'  => filter_var($isi, FILTER_VALIDATE_URL)
                                ? 'Kutip berita luar'
                                : $isi,

        'url_berita'        => filter_var($isi, FILTER_VALIDATE_URL) ? $isi : null,
        'gambar_berita'     => $namaGambar,
        'tanggal_berita'    => date('Y-m-d'),
        'status_berita'     => $this->request->getPost('status') ?: 'Publish'
    ]);

    session()->setFlashdata('success', true);
    session()->setFlashdata('last_id', $id);

    return redirect()->to('/tbc/berita');
}


    public function hapus(int $id)
    {
        $model = new BeritaTbcModel();
        $model->delete($id);

        return redirect()->to('/tbc/berita');
    }

    public function arsip(int $id)
    {
        $model = new BeritaTbcModel();

        $model->update($id, [
            'status_berita' => 'Draft'
        ]);

        return redirect()->to('/tbc/berita?status=Draft');
    }

    public function publish(int $id)
    {
        $model = new BeritaTbcModel();

        $model->update($id, [
            'status_berita' => 'Publish'
        ]);

        return redirect()->to('/tbc/berita');
    }

    public function edit(int $id)
    {
        $model = new BeritaTbcModel();

        return view('gol_b/admin/berita/edit', [
            'menu'   => 'berita',
            'judul'  => 'Edit Berita',
            'berita' => $model->find($id)
        ]);
    }

    public function update(int $id)
{
    $model = new BeritaTbcModel();

    $isi = $this->request->getPost('isi');

if (is_array($isi)) {
    $isi = implode('', $isi);
}

$isUrl = filter_var($isi, FILTER_VALIDATE_URL);

$data = [
    'judul_berita'      => $this->request->getPost('judul'),
    'deskripsi_berita'  => $isUrl ? 'Kutip berita luar' : $this->request->getPost('ringkasan'),
    'isi_berita'        => $isUrl ? null : $isi,
    'url_berita'        => $isUrl ? $isi : null,
    'tanggal_berita'    => $this->request->getPost('tanggal')
];

    $file = $this->request->getFile('gambar');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $nama = $file->getRandomName();
        $file->move('uploads/berita/', $nama);
        $data['gambar_berita'] = $nama;
    }

    $model->update($id, $data);

    return redirect()->to('/tbc/berita');
}

    public function detail(int $id)
    {
        $model = new BeritaTbcModel();

        return view('gol_b/admin/berita/detail', [
            'menu'   => 'berita',
            'judul'  => 'Detail Berita',
            'berita' => $model->find($id)
        ]);
    }
}