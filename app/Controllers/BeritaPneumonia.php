<?php

namespace App\Controllers;

use App\Models\BeritaPneumoniaModel;
use CodeIgniter\Controller;

class BeritaPneumonia extends Controller
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
    // =========================
    // LIST BERITA
    // =========================
    public function index()
    {
        $model = new BeritaPneumoniaModel();

        $status  = $this->request->getGet('status') ?? '';
        $keyword = $this->request->getGet('keyword') ?? '';

        $builder = $model->where('id_penyakit', 3);

        if ($status == 'publish') {
            $builder = $builder->where('status_berita', 'publish');
        }

        if ($status == 'draft') {
            $builder = $builder->where('status_berita', 'draft');
        }

        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('judul_berita', $keyword)
                ->orLike('deskripsi_berita', $keyword)
                ->groupEnd();
        }

        $beritapneumonia = $builder
            ->orderBy('tanggal_berita', 'DESC')
            ->findAll();

        $publish = $model
        ->where('id_penyakit', 3)
        ->where('status_berita', 'publish')
        ->countAllResults();

        $draft = $model
        ->where('id_penyakit', 3)
        ->where('status_berita', 'draft')
        ->countAllResults();

        $data = [
            'menu'            => 'berita',
            'judul'           => 'Kelola Berita',
            'beritapneumonia' => $beritapneumonia,
            'total'           => count($beritapneumonia),
            'publish'         => $publish,
            'draft'           => $draft,
            'status'          => $status,
            'keyword'         => $keyword,
            'notif' => $this->getNotif()
        ];

        return view('gol_c/berita/kelola_berita', $data);
    }

    // =========================
    // VIEW ADMIN
    // =========================
    public function view(int $id)
{
    $model = new BeritaPneumoniaModel();

    $data['beritapneumonia'] = $model->find($id);

    if (!$data['beritapneumonia']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_c/berita/view_berita', $data);
}

    // =========================
    // VIEW USER
    // =========================
    public function viewUser($id)
{
    $model = new BeritaPneumoniaModel();

    $data['beritapneumonia'] = $model->find($id);

    return view('gol_c/berita/view_user', $data);
}

    // =========================
    // TAMBAH
    // =========================
    public function tambah()
    {
        return view('gol_c/berita/tambah', [
            'judul' => 'Tambah Berita'
        ]);
    }

    // =========================
    // SIMPAN
    // =========================
    public function simpan()
    {
        $model = new BeritaPneumoniaModel();

        $namaFile = null;

        // UPLOAD GAMBAR
        $file = $this->request->getFile('gambar_berita');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $path = FCPATH . 'uploads/berita/';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $namaFile = $file->getRandomName();
            $file->move($path, $namaFile);
        }

        // AMBIL JUDUL
        $judul = $this->request->getPost('judul_berita');

        if (!$judul) {
            $judul = $this->request->getPost('judul_berita1');
        }
        $url = $this->request->getPost('url_berita');

        $gambarURL = null;

        if (!empty($url)) {

            $html = @file_get_contents($url);

            if ($html !== false) {

                preg_match('/<meta property="og:image" content="(.*?)"/', $html, $gambar);

                if (!empty($gambar[1])) {

                    $gambarURL = $gambar[1];

                }
            }
        }

        // DATA
        $data = [
            'id_petugas'       => session()->get('id_petugas') ?? null,
            'id_penyakit'      => 3,

            'judul_berita'     => $judul,
            'isi_berita'       => $this->request->getPost('isi_berita'),
            'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
            'url_berita'       => $this->request->getPost('url_berita'),
            'gambar_berita'    => $gambarURL ?? $namaFile,
            'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
            'penulis'   => $this->request->getPost('penulis'),
            'status_berita'    => $this->request->getPost('status_berita') ?? 'draft'
        ];

        $model->insert($data);

        $newId = $model->insertID();

        // DRAFT
        if (($data['status_berita'] ?? '') == 'draft') {

            session()->setFlashdata('draft', true);
            session()->setFlashdata('new_id', $newId);

            return redirect()->back();
        }

        // PUBLISH
        session()->setFlashdata('success', true);
        session()->setFlashdata('new_id', $newId);

        return redirect()->back();
    }

    // =========================
    // EDIT
    // =========================
    public function edit(int $id)
{
    $model = new BeritaPneumoniaModel();

    $data['beritapneumonia'] = $model->find($id);

    if (!$data['beritapneumonia']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_c/berita/tambah', $data);
}

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $model = new BeritaPneumoniaModel();

        $dataLama = $model->find($id);

        if (!$dataLama) {

            return redirect()
                ->to('/beritapneumonia/admin')
                ->with('error', 'Data tidak ditemukan');
        }

        // JUDUL
        $judul = $this->request->getPost('judul_berita');

        if (!$judul) {
            $judul = $this->request->getPost('judul_berita1');
        }

        // GAMBAR
        $namaFile = $dataLama['gambar_berita'];

        $file = $this->request->getFile('gambar_berita');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $path = FCPATH . 'uploads/berita/';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // HAPUS FILE LAMA
            if (!empty($dataLama['gambar_berita'])) {

                $oldFile = $path . $dataLama['gambar_berita'];

                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $namaFile = $file->getRandomName();
            $file->move($path, $namaFile);
        }

        // UPDATE DATA
        $updateData = [

            'id_petugas'       => session()->get('id_petugas') ?? 3,
            'id_penyakit'      => 3,

            'judul_berita'     => $judul,
            'isi_berita'       => $this->request->getPost('isi_berita'),
            'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
            'url_berita'       => $this->request->getPost('url_berita'),
            'gambar_berita'    => $namaFile,
            'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
            'penulis'   => $this->request->getPost('penulis'),
            'status_berita'    => $this->request->getPost('status_berita') ?? 'draft'
        ];

        $model->update($id, $updateData);

        // DRAFT
        if (($updateData['status_berita'] ?? '') == 'draft') {

            session()->setFlashdata('draft', true);
            session()->setFlashdata('new_id', $id);

            return redirect()->back();
        }

        // PUBLISH
        session()->setFlashdata('success', true);
        session()->setFlashdata('new_id', $id);

        return redirect()->back();
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $model = new BeritaPneumoniaModel();

        $data = $model->find($id);

        if (!$data) {

            return redirect()
                ->to('/beritapneumonia/admin')
                ->with('error', 'Data tidak ditemukan');
        }

        // HAPUS FILE
        if (!empty($data['gambar_berita'])) {

            $path = FCPATH . 'uploads/berita/' . $data['gambar_berita'];

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $model->delete($id);

        return redirect()
            ->to('/beritapneumonia/admin')
            ->with('success', 'Berita berhasil dihapus');
    }

    // =========================
    // LIST BERITA USER
    // =========================
    public function list_berita()
    {
        $model = new BeritaPneumoniaModel();

       $data['berita'] = $model
            ->where('id_penyakit', 3)
            ->where('status_berita', 'publish')
            ->orderBy('tanggal_berita', 'DESC')
            ->findAll();

        return view('gol_c/berita/list_berita', $data);
    }

    // =========================
    // UPLOAD IMAGE EDITOR
    // =========================
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
            'url' => base_url('uploads/berita/' . $newName)
        ]);
    }
}