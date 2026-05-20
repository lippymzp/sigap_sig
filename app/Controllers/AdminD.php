<?php

namespace App\Controllers;
use App\Models\BeritaModelDD;
use App\Models\FunfactModelD;
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
    $keyword = $this->request->getGet('keyword');

    $builder = $model->where('id_penyakit', 4);

    if ($tab == 'draft') {
        $builder->where('status_berita', 'draft');
    } else {
        $builder->where('status_berita', 'publish');
    }

    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('judul_berita', $keyword)
            ->orLike('deskripsi_berita', $keyword)
            ->orLike('penulis', $keyword)
            ->groupEnd();
    }

    $berita = $builder
        ->orderBy('id_berita', 'DESC')
        ->findAll();

    $totalPublish = $model
        ->where('id_penyakit', 4)
        ->where('status_berita', 'publish')
        ->countAllResults();

    $totalDraft = $model
        ->where('id_penyakit', 4)
        ->where('status_berita', 'draft')
        ->countAllResults();

    return view('gol_d/berita/index', [
        'berita' => $berita,
        'tab' => $tab,
        'keyword' => $keyword,
        'totalPublish' => $totalPublish,
        'totalDraft' => $totalDraft
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
    $funfactModel = new FunfactModelD();

    $status = $this->request->getGet('status') ?? 'publish';
    $keyword = $this->request->getGet('keyword');

    $query = $funfactModel
        ->where('id_penyakit', 4)
        ->where('status_funfact', $status);

    if (!empty($keyword)) {
        $query->groupStart()
            ->like('judul_funfact', $keyword)
            ->orLike('deskripsi_funfact', $keyword)
            ->orLike('isi_funfact', $keyword)
            ->groupEnd();
    }

    $data['status'] = $status;
    $data['keyword'] = $keyword;

    $data['funfact'] = $query
        ->orderBy('id_funfact', 'DESC')
        ->findAll();

    $data['totalPublish'] = $funfactModel
        ->where('id_penyakit', 4)
        ->where('status_funfact', 'publish')
        ->countAllResults();

    $data['totalDraft'] = $funfactModel
        ->where('id_penyakit', 4)
        ->where('status_funfact', 'draft')
        ->countAllResults();

    return view('gol_d/admin/funfact', $data);
}

public function tambahFunfact()
{
    return view('gol_d/admin/tambah_funfact');
}

public function simpanFunfact()
{
    $model = new FunfactModelD();

    $gambar = $this->request->getFile('gambar_funfact');
    $namaGambar = '';

    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/funfact', $namaGambar);
    }

    $status = $this->request->getPost('status_funfact') ?? 'draft';

    $model->save([
        'id_penyakit'        => 4,
        'judul_funfact'      => $this->request->getPost('judul_funfact'),
        'deskripsi_funfact'  => $this->request->getPost('deskripsi_funfact'),
        'isi_funfact'        => $this->request->getPost('isi_funfact'),
        'gambar_funfact'     => $namaGambar,
        'tanggal_funfact'    => date('Y-m-d H:i:s'),
        'status_funfact'     => $status,
        'penulis'            => 'Admin'
    ]);

    session()->setFlashdata('success', 'Funfact berhasil disimpan');

    return redirect()->to('/admind/funfact?status=' . $status);
}

public function editFunfact($id)
{
    $model = new FunfactModelD();

    $data['funfact'] = $model->find($id);

    return view('gol_d/admin/edit_funfact', $data);
}

public function updateFunfact($id)
{
    $model = new FunfactModelD();

    $dataUpdate = [
        'judul_funfact'     => $this->request->getPost('judul_funfact'),
        'deskripsi_funfact' => $this->request->getPost('deskripsi_funfact'),
        'isi_funfact'       => $this->request->getPost('isi_funfact'),
    ];

    $gambar = $this->request->getFile('gambar_funfact');

    if ($gambar && $gambar->isValid()) {
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/funfact', $namaGambar);
        $dataUpdate['gambar_funfact'] = $namaGambar;
    }

    $model->update($id, $dataUpdate);

    return redirect()->to('/admind/funfact');
}

public function hapusFunfact($id)
{
    $model = new FunfactModelD();

    $model->delete($id);

    return redirect()->to('/admind/funfact');
}

public function publishFunfact($id)
{
    $funfactModel = new FunfactModelD();

    $funfactModel->update($id, [
        'status_funfact' => 'publish'
    ]);

    session()->setFlashdata('success', 'Funfact berhasil dipublish');

    return redirect()->to('/admind/funfact?status=published');
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
public function detailBerita($id)
{
    $model = new \App\Models\BeritaModelDD();

    $berita = $model->find($id);

    if (!$berita) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_d/berita/detail', [
        'berita' => $berita
    ]);
}

public function draftFunfact($id)
{
    $funfactModel = new \App\Models\FunfactModelD();

    $funfactModel->update($id, [
        'status_funfact' => 'draft'
    ]);

    session()->setFlashdata('success', 'Funfact dipindah ke draft');

    return redirect()->to('/admind/funfact?status=draft');
}

}