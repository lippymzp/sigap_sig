<?php

namespace App\Controllers;
use App\Models\BeritaModelDD;
class AdminD extends BaseController
{
    public function __construct()
    {
        helper('text');
    }
public function berita()
{
    $model = new BeritaModelDD();

    $tab = $this->request->getGet('tab') ?? 'publish';

    if ($tab == 'draft') {
        $berita = $model
            ->where('id_penyakit', 4)
            ->where('status_berita', 'draft')
            ->orderBy('id_berita', 'DESC')
            ->findAll();
    } else {
        $berita = $model
            ->where('id_penyakit', 4)
            ->where('status_berita', 'publish')
            ->orderBy('id_berita', 'DESC')
            ->findAll();
    }

    return view('gol_d/berita/index', [
        'berita' => $berita,
        'tab' => $tab
    ]);
}
    public function skrining()
    {
        $db = \Config\Database::connect();

        $data['judul'] = 'Data Skrining';
        $data['menu'] = 'skrining';
        $data['penyakit'] = 'diare';

        $builder = $db->table('skrining');
        $builder->select('
    skrining.*,
    pasien_skrining.nik,
    pasien_skrining.nama_pasien_skrining,
    pasien_skrining.usia,
    pasien_skrining.jenis_kelamin,
    pasien_skrining.no_hp
');

        $builder->join(
            'pasien_skrining',
            'pasien_skrining.id_pasien_skrining = skrining.id_pasien_skrining'
        );

        $builder->where('skrining.id_penyakit', 4);
        $builder->orderBy('skrining.id_skrining', 'DESC');

        $data['skrining'] = $builder->get()->getResultArray();

        return view('gol_d/admin/skrining', $data);
    }

    public function funfact()
    {
        echo "halaman funfact";
    }

    public function profil()
    {
        echo "halaman profil";
    }

    public function export()
    {
        echo "halaman export";
    }
    public function tambahBerita()
{
    return view('gol_d/berita/tambah');
}
public function simpanBerita()
{
    $file = $this->request->getFile('gambar_berita');

    $namaFile = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/berita', $namaFile);
    }

    $action = $this->request->getPost('action');
    $status = ($action === 'draft') ? 'draft' : 'publish';

    $model = new BeritaModelDD();

    $model->save([
        'judul_berita'     => $this->request->getPost('judul_berita'),
        'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
        'isi_berita'       => $this->request->getPost('isi_berita'),
        'penulis'          => $this->request->getPost('penulis'),
        'tanggal_berita'   => $this->request->getPost('tanggal_berita'),
        'gambar_berita'    => $namaFile,
        'status_berita'    => $status,
        'id_penyakit'      => 4
    ]);

    if ($status == 'draft') {
        return redirect()->to(base_url('admind/berita?tab=draft'))
            ->with('success', 'Draft berhasil disimpan');
    }

    return redirect()->to(base_url('admind/berita?tab=publish'))
        ->with('success', 'Berita berhasil diunggah');
}
public function hapusBerita($id)
{
    $model = new BeritaModelDD();

    $berita = $model->find($id);

    if ($berita && !empty($berita['gambar_berita'])) {
        $path = FCPATH . 'uploads/berita/' . $berita['gambar_berita'];

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $model->delete($id);

    return redirect()->to('admind/berita');
}
public function editBerita($id)
{
    $model = new BeritaModelDD();

    $data['judul'] = 'Edit Berita';
    $data['menu'] = 'berita';
    $data['penyakit'] = 'diare';

    $data['berita'] = $model->find($id);

    return view('gol_d/berita/edit', $data);
}
public function updateBerita($id)
{
    $model = new BeritaModelDD();

    $file = $this->request->getFile('gambar_berita');
    $namaFile = $this->request->getPost('gambar_lama');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/berita', $namaFile);
    }

    $model->update($id, [
        'judul_berita' => $this->request->getPost('judul_berita'),
        'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
        'isi_berita' => $this->request->getPost('isi_berita'),
        'gambar_berita' => $namaFile,
        'tanggal_berita' => $this->request->getPost('tanggal_berita'),
        'penulis' => $this->request->getPost('penulis')
    ]);

    return redirect()->to('admind/berita');
}
public function publishBerita($id)
{
    $model = new BeritaModelDD();

    $model->update($id, [
        'status_berita' => 'publish'
    ]);

    return redirect()->to('admind/berita');
}
}