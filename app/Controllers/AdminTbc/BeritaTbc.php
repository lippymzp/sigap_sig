<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\BeritaTbcModel;

class BeritaTbc extends BaseController
{
    public function index()
    {
        $model = new BeritaTbcModel();

        // default tampil Publish
        $status = $this->request->getGet('status') ?? 'Publish';

        $total   = $model->countAll();

        $publish = $model->where('status_berita', 'Publish')
                         ->countAllResults();

        $draft   = $model->where('status_berita', 'Draft')
                         ->countAllResults();

        $arsip   = $model->where('status_berita', 'Arsip')
                         ->countAllResults();

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

        $model->save([
            'judul_berita'      => $this->request->getPost('judul'),
            'isi_berita'        => $this->request->getPost('isi'),
            'deskripsi_berita'  => $this->request->getPost('ringkasan'),
            'penulis'           => $this->request->getPost('penulis'),
            'tanggal_berita'    => $this->request->getPost('tanggal'),
            'status_berita'     => $this->request->getPost('status') ?: 'Publish',
            'gambar_berita'     => $namaGambar
        ]);

        return redirect()->to('/tbc/berita');
    }

    public function simpanKutip()
    {
        $model = new BeritaTbcModel();

        $model->save([
            'judul_berita'      => $this->request->getPost('judul'),
            'isi_berita'        => $this->request->getPost('link'),
            'deskripsi_berita'  => 'Kutip berita luar',
            'penulis'           => 'Admin',
            'tanggal_berita'    => date('Y-m-d'),
            'status_berita'     => $this->request->getPost('status') ?: 'Publish',
            'gambar_berita'     => 'default.jpg'
        ]);

        return redirect()->to('/tbc/berita');
    }

    public function hapus($id)
    {
        $model = new BeritaTbcModel();
        $model->delete($id);

        return redirect()->to('/tbc/berita');
    }

    public function arsip($id)
    {
        $model = new BeritaTbcModel();

        $model->update($id, [
            'status_berita' => 'Draft'
        ]);

        return redirect()->to('/tbc/berita?status=Draft');
    }

    public function publish($id)
    {
        $model = new BeritaTbcModel();

        $model->update($id, [
            'status_berita' => 'Publish'
        ]);

        return redirect()->to('/tbc/berita');
    }

    public function edit($id)
    {
        $model = new BeritaTbcModel();

        return view('gol_b/admin/berita/edit', [
            'menu'   => 'berita',
            'judul'  => 'Edit Berita',
            'berita' => $model->find($id)
        ]);
    }

    public function update($id)
    {
        $model = new BeritaTbcModel();

        $data = [
            'judul_berita'      => $this->request->getPost('judul'),
            'isi_berita'        => $this->request->getPost('isi'),
            'deskripsi_berita'  => $this->request->getPost('ringkasan'),
            'penulis'           => $this->request->getPost('penulis'),
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

    public function detail($id)
    {
        $model = new BeritaTbcModel();

        return view('gol_b/admin/berita/detail', [
            'menu'   => 'berita',
            'judul'  => 'Detail Berita',
            'berita' => $model->find($id)
        ]);
    }
}