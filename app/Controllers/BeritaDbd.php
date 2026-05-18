<?php

namespace App\Controllers;
use App\Models\BeritaDbdModel;
use App\Models\PetugasModel;
use CodeIgniter\Controller;

class BeritaDbd extends Controller
{
      // =========================
    // HALAMAN LIST BERITA
    // =========================
    public function index()
    {
        $model = new BeritaDbdModel();

    $status = $this->request->getGet('status') ?? '';
    $keyword = $this->request->getGet('keyword');

    $builder = $model;
        // ambil semua data
    $berita = $model->findAll();

    // FILTER STATUS
    if ($status == 'publish') {
        $builder = $builder->where('status_berita', 'publish');
    }

    if ($status == 'draft') {
        $builder = $builder->where('status_berita', 'draft');
    }

    // SEARCH
    if (!empty($keyword)) {

        $builder = $builder->groupStart()
            ->like('judul_berita', $keyword)
            ->orLike('deskripsi_berita', $keyword)
            ->groupEnd();
    }

    $berita = $builder->findAll();

    // hitung manual (PALING AMAN & TIDAK ERROR CI4)
    $publish = 0;
    $draft = 0;

    foreach ($berita as $b) {
        $status = strtolower(trim($b['status_berita'] ?? 'draft'));
            if ($status === 'publish') {
                $publish++;
            } else {
                $draft++;
            }
    }

    $data = [
        'menu' => 'berita',
        'judul' => 'Kelola Berita', 
        'berita' => $berita,
        'total' => count($berita),
        'publish' => $publish,
        'draft' => $draft,
        'status' => ''
    ];

    return view('gol_a/berita/kelola_berita', $data);
}

    // VIEW DETAIL
    public function view(int $id)
    {
        $model = new BeritaDbdModel();
        $data['berita'] = $model->find($id);

        return view('gol_a/berita/view_berita', $data);
    }
    public function viewUser(int $id)
    {
        $model = new BeritaDbdModel();
        $data['berita'] = $model->find($id);

        return view('gol_a/berita/view_user', $data);
    }

    // EDIT STATUS (PUBLISH / DRAFT)
    public function toggleStatus(int $id)
    {
        $model = new BeritaDbdModel();
        $berita = $model->find($id);

        $newStatus = ($berita['status_berita'] == 'publish') ? 'draft' : 'publish';

        $model->update($id, [
            'status_berita' => $newStatus
        ]);

        return redirect()->to('/berita');
    }

    // DELETE
    public function delete(int $id)
{
    $model = new \App\Models\BeritaDbdModel();

    $data = $model->find($id);

    // 🔥 kalau data tidak ada
    if (!$data) {
        return redirect()->to('/berita')->with('error', 'Data tidak ditemukan');
    }

    // 🔥 hapus gambar juga (optional tapi bagus)
    if (!empty($data['gambar_berita']) && file_exists('public/uploads/berita/' . $data['gambar_berita'])) {
        unlink('public/uploads/berita/' . $data['gambar_berita']);
    }

    $model->delete($id);

    return redirect()->to('/berita')->with('success', 'Data berhasil dihapus');
}

    // TAMPIL HALAMAN FORM
    public function tambah()
    {
        return view('gol_a/berita/tambah', [
            'title' => 'Tambah Berita'
        ]);
    }
    
    private function cleanHtml(?string $text): ?string
{
    if (!$text) return $text;

    // hapus font tag
    $text = preg_replace('/<font[^>]*>/', '', $text);
    $text = preg_replace('/<\/font>/', '', $text);

    // hapus style rusak
    $text = preg_replace('/style="[^"]*"/', '', $text);

    // hapus string rusak
    $text = str_replace('">', '', $text);

    return $text;
}

    // PROSES SIMPAN DATA
    public function simpan()
{
    $model = new BeritaDbdModel();
    $petugasModel = new PetugasModel();

    // =====================
    // AMBIL ID PETUGAS DARI SESSION
    // =====================
    $id_petugas = session()->get('id_petugas');
    $petugas = $petugasModel->find($id_petugas);
    $id_penyakit = $petugas['id_penyakit'] ?? null;

    $file = $this->request->getFile('gambar_berita');
    $namaFile = null;

    // =====================
    // UPLOAD GAMBAR
    // =====================
    $file = $this->request->getFile('gambar_berita');
    $namaFile = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $path = FCPATH . 'uploads/berita/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $namaFile = $file->getRandomName();
        $file->move($path, $namaFile);
    }
    // =====================
    // AMBIL JUDUL
    // =====================
    $judul = $this->request->getPost('judul_berita')
        ?? $this->request->getPost('judul_berita1');

    // =====================
    // DATA INSERT
    // =====================
    $data = [
        'id_petugas'       => $id_petugas,
        'id_penyakit'      => $id_penyakit,
        'penulis'          => $this->request->getPost('penulis'),
        'judul_berita'     => $judul,
        'isi_berita'       => $this->request->getPost('isi_berita'),
        'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
        'url_berita'       => $this->request->getPost('url_berita'),
        'gambar_berita'    => $namaFile,
        'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
        'status_berita'    => $this->request->getPost('status_berita') ?? 'draft'
    ];

    $model->insert($data);
        // ambil ID hasil insert
    $newId = $model->insertID();

    // FLASHDATA (untuk popup & redirect)
    session()->setFlashdata('success', 'Berita berhasil disimpan!');
    session()->setFlashdata('new_id', $newId);

    return redirect()->back();
}


    // =========================
    // FILTER PUBLISH
    // =========================
    public function publish()
{
    $model = new \App\Models\BeritaDbdModel();

    $berita = $model->where('status_berita', 'publish')->findAll();

    $data = [
        'berita' => $berita,
        'total' => count($berita),
        'publish' => count($berita),
        'draft' => 0,
        'status' => 'publish'
    ];

    return view('gol_a/berita/kelola_berita', $data);
}

    // =========================
    // FILTER DRAFT
    // =========================
    public function draft()
{
    $model = new \App\Models\BeritaDbdModel();

    $berita = $model->where('status_berita', 'draft')->findAll();

    $data = [
        'berita' => $berita,
        'total' => count($berita),
        'publish' => 0,
        'draft' => count($berita),
        'status' => 'draft'
    ];

    return view('gol_a/berita/kelola_berita', $data);
}

public function filter(int $type)
{
    $model = new \App\Models\BeritaDbdModel();

    if ($type == 'publish') {
        $berita = $model->where('status_berita', 'publish')->findAll();
    } elseif ($type == 'draft') {
        $berita = $model->where('status_berita', 'draft')->findAll();
    } else {
        $berita = $model->findAll();
    }

    // 🔥 langsung generate HTML (tanpa file view baru)
    $html = '';

    foreach ($berita as $b) {
        $html .= '
        <div class="card-berita">
            <div class="card-left">
                <img src="public/uploads/berita/'.$b['gambar_berita'].'">

                <div class="card-info">
                    <h4>'.$b['judul_berita'].'</h4>
                    <p>'.strip_tags($b['isi_berita']).'</p>
                    <p>'.strip_tags($b['deskripsi_berita']).'</p>
                    <small>'.$b['tanggal_berita'].'</small>
                </div>
            </div>
        </div>';
    }

    return $html;
}
public function edit(int $id)
{
    $model = new BeritaDbdModel();

    $data['berita'] = $model->find($id);

    return view('gol_a/berita/tambah', $data);
}
public function update(int $id)
{
    $model = new BeritaDbdModel();
    $petugasModel = new PetugasModel();

    // =====================
    // AMBIL ID PETUGAS DARI SESSION
    // =====================
    $id_petugas = session()->get('id_petugas');

    // =====================
    // AMBIL DATA PETUGAS
    // =====================
    $petugas = $petugasModel->find($id_petugas);

    // =====================
    // AMBIL ID PENYAKIT
    // =====================
    $id_penyakit = $petugas['id_penyakit'] ?? null;

    // =====================
    // CEK DATA BERITA LAMA
    // =====================
    $dataLama = $model->find($id);

    if (!$dataLama) {
        return redirect()->to('/berita')
            ->with('error', 'Data tidak ditemukan!');
    }

    // ✔️ FIX JUDUL
    $judul = $this->request->getPost('judul_berita');
    if (!$judul) {
        $judul = $this->request->getPost('judul_berita1');
    }
    

    $file = $this->request->getFile('gambar_berita');
    $namaFile = $dataLama['gambar_berita']; // default tetap gambar lama


    if ($file && $file->isValid() && !$file->hasMoved()) {

        $path = FCPATH . 'uploads/berita/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // hapus lama
        if (!empty($dataLama['gambar_berita'])) {
            $oldPath = $path . '/' . $dataLama['gambar_berita'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $namaFile = $file->getRandomName();
        $file->move($path, $namaFile);
    }

    $model->update($id, [
        'id_petugas'       => $id_petugas,
        'id_penyakit'      => $id_penyakit,
        'judul_berita'     => $judul,
        'isi_berita'        => $this->request->getPost('isi_berita'),
        'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
        'url_berita'       => $this->request->getPost('url_berita'),
        'gambar_berita'    => $namaFile,
        'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
        'status_berita'    => $this->request->getPost('status_berita') ?? 'draft'
    ]);

    return redirect()->to('/berita')
    ->with('success', 'Berita berhasil diupdate!')
    ->with('new_id', $id);
}
public function list_berita()
{
    $model = new BeritaDbdModel();

    $data['berita'] = $model
        ->where('status_berita', 'publish')
        ->orderBy('tanggal_berita', 'DESC')
        ->findAll();

    return view('gol_a/berita/list_berita', $data);
}
public function uploadEditorImage()
{
    $file = $this->request->getFile('image');

    if (!$file || !$file->isValid()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Upload gagal'
        ]);
    }

    $path = FCPATH . 'uploads/berita/';

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $newName = $file->getRandomName();
    $file->move($path, $newName);

    return $this->response->setJSON([
        'status' => 'success',
        'url' => base_url('public/uploads/berita/' . $newName)
    ]);
}
}

