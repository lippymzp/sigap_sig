<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FunfactTbcModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
    $this->artikelModel = new FunfactTbcModel();
    }

    public function index()
    {
    $model = new FunfactTbcModel();
        $keyword  = $this->request->getGet('search');
        $status   = $this->request->getGet('status');
        $tanggal  = $this->request->getGet('tanggal');
        $urutkan  = $this->request->getGet('urutkan');

        if ($keyword) {
            $model->like('judul_artikel', $keyword);
        }

        if ($status) {
            $model->where('status_artikel', $status);
        }

        if ($tanggal) {
            $model->where('tanggal_artikel', $tanggal);
        }

        if ($urutkan == 'terbaru') {
            $model->orderBy('tanggal_artikel', 'DESC');
        }

        if ($urutkan == 'terlama') {
            $model->orderBy('tanggal_artikel', 'ASC');
        }

        $data = [
            'artikel' => $model->paginate(8),
            'pager'   => $model->pager,
            'total'   => $model->countAll(),
            'keyword' => $keyword
        ];

        return view('admin/artikel/index', $data);
    }

    public function create()
    {
        return view('admin/artikel/create');
    }

    public function store()
    {
        $rules = [
            'judul_artikel' => 'required',
            'deskripsi_artikel' => 'required',
            'status_artikel' => 'required',
            'gambar_artikel' => 'uploaded[gambar_artikel]|max_size[gambar_artikel,2048]|is_image[gambar_artikel]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $file = $this->request->getFile('gambar_artikel');
        $namaGambar = $file->getRandomName();
        $file->move(FCPATH . 'uploads/artikel', $namaGambar);

        $this->artikelModel->save([
            'judul_artikel'     => $this->request->getPost('judul_artikel'),
            'deskripsi_artikel' => $this->request->getPost('deskripsi_artikel'),
            'status_artikel'    => $this->request->getPost('status_artikel'),
            'gambar_artikel'    => $namaGambar,
            'tanggal_artikel'   => date('Y-m-d')
        ]);

        return redirect()->to(base_url('admin/artikel'))
            ->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $artikel = $this->artikelModel->find($id);

        return view('admin/artikel/show', [
            'artikel' => $artikel
        ]);
    }

    public function toggle($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return $this->response->setJSON(['status' => 'error']);
        }

        $newStatus = $artikel['status_artikel'] === 'Publish'
            ? 'Unpublish'
            : 'Publish';

        $this->artikelModel->update($id, [
            'status_artikel' => $newStatus
        ]);

        return $this->response->setJSON([
            'status' => $newStatus
        ]);
    }

    public function delete($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if (!empty($artikel['gambar_artikel'])) {
            $path = FCPATH . 'uploads/artikel/' . $artikel['gambar_artikel'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->artikelModel->delete($id);

        return redirect()->to(base_url('admin/artikel'))
            ->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->to('admin/artikel')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/artikel/edit', [
            'artikel' => $artikel
        ]);
    }

    public function update($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->back();
        }

        $file = $this->request->getFile('gambar_artikel');
        $namaGambar = $artikel['gambar_artikel'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($artikel['gambar_artikel'])) {
                $oldPath = FCPATH . 'uploads/artikel/' . $artikel['gambar_artikel'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $namaGambar = $file->getRandomName();
            $file->move(FCPATH . 'uploads/artikel', $namaGambar);
        }

        $this->artikelModel->update($id, [
            'judul_artikel'     => $this->request->getPost('judul_artikel'),
            'deskripsi_artikel' => $this->request->getPost('deskripsi_artikel'),
            'status_artikel'    => $this->request->getPost('status_artikel'),
            'gambar_artikel'    => $namaGambar
        ]);

        return redirect()->to('admin/artikel')
            ->with('success', 'Data berhasil diperbarui');
    }
}   