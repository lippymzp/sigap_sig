<?php

namespace App\Controllers;
use App\Models\BeritaDbdModel;
use CodeIgniter\Controller;

class BeritaDbd extends Controller
{
      // =========================
    // HALAMAN LIST BERITA
    // =========================
    public function index()
    {
        $model = new BeritaDbdModel();
        // ambil semua data
    $berita = $model->findAll();

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
        'berita' => $berita,
        'total' => count($berita),
        'publish' => $publish,
        'draft' => $draft
    ];

    return view('gol_a/berita/kelola_berita', $data);
}

    // VIEW DETAIL
    public function view(int $id)
    {
        $model = new BeritaDbdModel();
        $data['berita'] = $model->find($id);

        return view('gol_a/berita/detail', $data);
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
    if (!empty($data['gambar_berita']) && file_exists('uploads/' . $data['gambar_berita'])) {
        unlink('uploads/' . $data['gambar_berita']);
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

    private function cleanHtml($text)
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
        $db = \Config\Database::connect();

        // 🔥 VALIDASI DULU (WAJIB DI AWAL)
        $rules = [
            'judul_berita'    => 'required',
            'deskripsi_berita'=> 'required',
            'tanggal_berita'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', 'Semua data wajib diisi!')
                ->withInput();
        }

        // 🔥 VALIDASI SESSION PETUGAS
        if (!session()->get('id_petugas')) {
            return redirect()->back()
                ->with('error', 'Session petugas tidak ditemukan!')
                ->withInput();
        }

        // ambil file
        $file = $this->request->getFile('gambar_berita');

        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
        }

        // ambil status (draft / publish dari tombol)
        $status = $this->request->getPost('status_berita');

        // kalau tidak ada (fallback)
        if (!$status) {
            $status = 'draft';
        }

        // ambil judul dulu
        $judul = $this->request->getPost('judul_berita')
            ?? $this->request->getPost('judul_berita1');
        
        // baru masuk ke array
        $data = [
            'id_petugas'        => session()->get('id_petugas'),
            'judul_berita'      => $judul,
            'deskripsi_berita'  => $this->cleanHtml($this->request->getPost('deskripsi_berita')),
            'url_berita'        => $this->request->getPost('url_berita'),
            'gambar_berita'     => $namaFile,
            'tanggal_berita'    => $this->request->getPost('tanggal_berita'),
            'status_berita'     => $status
        ];

        // insert ke database
        $model = new BeritaDbdModel();
        $model->insert($data);

        // redirect balik + pesan
        return redirect()->to('/berita/tambah')
                         ->with('success', 'Berita berhasil disimpan!');
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
        'draft' => 0
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
        'draft' => count($berita)
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
                <img src="/uploads/'.$b['gambar_berita'].'">

                <div class="card-info">
                    <h4>'.$b['judul_berita'].'</h4>
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
    $dataLama = $model->find($id);

    if (!$dataLama) {
        return redirect()->to('/berita')
            ->with('error', 'Data tidak ditemukan!');
    }

    // ✔️ FIX JUDUL
    $judul = $this->request->getPost('judul_berita')
            ?? $this->request->getPost('judul_berita1');
    

    $file = $this->request->getFile('gambar_berita');

    if ($file && $file->isValid() && !$file->hasMoved()) {

        if (!empty($dataLama['gambar_berita']) && file_exists('uploads/' . $dataLama['gambar_berita'])) {
            unlink('uploads/' . $dataLama['gambar_berita']);
        }

        $namaFile = $file->getRandomName();
        $file->move('uploads/', $namaFile);
    } else {
        $namaFile = $dataLama['gambar_berita'];
    }

    $model->update($id, [
        'judul_berita'     => $judul,
        'deskripsi_berita' => $this->cleanHtml($this->request->getPost('deskripsi_berita')),
        'url_berita'       => $this->request->getPost('url_berita'),
        'gambar_berita'    => $namaFile,
        'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
        'status_berita'    => $this->request->getPost('status_berita') ?? 'draft'
    ]);

    return redirect()->to('/berita')->with('success', 'Berita berhasil diupdate!');
}
}

