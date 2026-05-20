<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunfactPneumoniaModel;

class funfactpneumonia extends BaseController
{
    private function getNotif()
{
    $db = \Config\Database::connect();

    return $db->table('skrining s')

        ->select('
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            s.tanggal,
            s.hasil
        ')

        ->join(
            'pasien_skrining p',
            'p.id_pasien_skrining = s.id_pasien_skrining'
        )

        ->where('s.id_penyakit', 3)

        ->where('s.hasil', 'Berisiko')

        ->orderBy('s.id_skrining', 'DESC')

        ->limit(3)

        ->get()

        ->getResultArray();
}
    public function index()
    {
        $model = new FunfactPneumoniaModel();

        $status = $this->request->getGet('status') ?? 'Publish';
        $keyword = $this->request->getGet('keyword');

        $total = (clone $model)
            ->where('id_penyakit', 3)
            ->countAllResults();

        $publish = (clone $model)
            ->where('id_penyakit', 3)
            ->where('status_funfact', 'Publish')
            ->countAllResults();

        $draft = (clone $model)
            ->where('id_penyakit', 3)
            ->where('status_funfact', 'Draft')
            ->countAllResults();

        $arsip = (clone $model)
            ->where('id_penyakit', 3)
            ->where('status_funfact', 'Arsip')
            ->countAllResults();

        $query = (clone $model)
            ->where('status_funfact', $status);

        if($keyword){
            $query->like('judul_funfact', $keyword);
        }

        $funfact = $query
            ->orderBy('id_funfact', 'DESC')
            ->findAll();

        return view('gol_c/funfact', [
            'menu'    => 'funfact',
            'judul'   => 'Kelola Funfact',
            'total'   => $total,
            'publish' => $publish,
            'draft'   => $draft,
            'arsip'   => $arsip,
            'status'  => $status,
            'funfact' => $funfact,
            'notif' => $this->getNotif()
        ]);
    }

    public function create()
    {
        return view('gol_c/funfact/create', [
            'menu'  => 'funfact',
            'judul' => 'Unggah Funfact'
        ]);
    }

    public function simpan()
{
    $model = new FunfactPneumoniaModel();

    $judul = $this->request->getPost('judul');
    $isi   = $this->request->getPost('isi');

    // VALIDASI
    $penulis = $this->request->getPost('penulis');

    if (!$judul || !$isi || !$penulis) {
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

    // SIMPAN & AMBIL ID
    $id = $model->insert([
        'id_petugas'        => session()->get('id_petugas') ?? 1,
        'id_penyakit'       => 3,
        'judul_funfact'     => $judul,
        'penulis'   => $this->request->getPost('penulis'),
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

    // SIMPAN ID UNTUK POPUP DETAIL
    session()->setFlashdata('last_id', $id);
    session()->setFlashdata('success', 'unggah');

    return redirect()->to('pneumonia/funfact');
}
    

    public function hapus(int $id)
    {
        $model = new FunfactPneumoniaModel();
        $model->delete($id);

        return redirect()->to('pneumonia/funfact');
    }

    public function arsip(int $id)
    {
        $model = new FunfactPneumoniaModel();

        $model->update($id, [
            'status_funfact' => 'Draft'
        ]);

        return redirect()->to('pneumonia/funfact?status=Draft');
    }

    public function publish(int $id)
    {
        $model = new FunfactPneumoniaModel();

        $model->update($id, [
            'status_funfact' => 'Publish'
        ]);

        return redirect()->to('pneumonia/funfact');
    }

    public function edit(int $id)
    {
        $model = new FunfactPneumoniaModel();

        return view('gol_c/funfact/edit', [
            'menu'    => 'funfact',
            'judul'   => 'Edit Funfact',
            'funfact' => $model->find($id)
        ]);
    }

    public function update(int $id)
{
    $model = new FunfactPneumoniaModel();

    $isi = $this->request->getPost('isi');
    $status = $this->request->getPost('status');

    $data = [
        'judul_funfact'     => $this->request->getPost('judul'),
        'penulis' => $this->request->getPost('penulis'),
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

    session()->setFlashdata('success', 'edit');

    return redirect()->to('pneumonia/funfact');
}

    public function detail(int $id)
    {
        $model = new FunfactPneumoniaModel();

        return view('gol_c/funfact/detail', [
            'menu'    => 'funfact',
            'judul'   => 'Detail Funfact',
            'funfact' => $model->find($id)
        ]);
    }
}