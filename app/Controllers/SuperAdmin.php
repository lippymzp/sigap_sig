<?php

namespace App\Controllers;
use App\Models\IklanModel;
class SuperAdmin extends BaseController
{
    public function dashboard()
    {
        return view('superadmin/dashboard', [
            'judul' => 'Dashboard',
            'menu' => 'dashboard'
        ]);
    }

    public function iklan()
{
    $model = new IklanModel();

    $data['iklan'] = $model
        ->orderBy('urutan', 'ASC')
        ->findAll();

    $data['judul'] = 'Iklan Portal';
    $data['menu'] = 'iklan';

    return view('superadmin/manajemen_iklan', $data);
}

    public function admin()
    {
        return view('superadmin/manajemen_admin', [
            'judul' => 'Manajemen Admin',
            'menu' => 'admin'
        ]);
    }

    public function puskesmas()
    {
        return view('superadmin/manajemen_puskesmas', [
            'judul' => 'Manajemen Puskesmas',
            'menu' => 'puskesmas'
        ]);
    }

    public function profil()
    {
        return view('superadmin/profil_sistem', [
            'judul' => 'Profil Sistem',
            'menu' => 'profil'
        ]);
    }
  public function simpanIklan()
{
    $iklanModel = new IklanModel();

    $gambar = $this->request->getFile('gambar');

    $namaGambar = 'default-banner.png';

    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/iklan', $namaGambar);
    }

    $iklanModel->save([
        'judul'     => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'gambar'    => $namaGambar,
        'status'    => $this->request->getPost('status'),
        'urutan'    => $this->request->getPost('urutan')
    ]);

    return redirect()->to('/superadmin/manajemen-iklan')
                     ->with('success', 'Iklan berhasil disimpan');
}
public function hapusIklan($id)
{
    $model = new IklanModel();

    $iklan = $model->find($id);

    if ($iklan) {
        unlink('uploads/iklan/' . $iklan['gambar']);
        $model->delete($id);
    }

    return redirect()->to('/superadmin/iklan')
        ->with('success', 'Iklan berhasil dihapus');
}
public function updateIklan($id)
{
    $model = new IklanModel();

    $data = [
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'status' => $this->request->getPost('status'),
        'urutan' => $this->request->getPost('urutan')
    ];

    $gambar = $this->request->getFile('gambar');

    if ($gambar && $gambar->isValid()) {
        $nama = $gambar->getRandomName();
        $gambar->move('uploads/iklan', $nama);
        $data['gambar'] = $nama;
    }

    $model->update($id, $data);

    return redirect()->to('/superadmin/iklan')
        ->with('success', 'Iklan berhasil diupdate');
}
public function formTambahIklan()
{
    return view('superadmin/form_tambah_iklan', [
        'title' => 'Tambah Iklan',
        'judul' => 'Iklan Portal',
        'menu'  => 'iklan'
    ]);
}
public function manajemenIklan()
{
    
    $iklanModel = new IklanModel();

    $data['iklan'] = $iklanModel
        ->orderBy('urutan', 'ASC')
        ->findAll();

    $data['title'] = 'Manajemen Iklan';
    $data['judul'] = 'Iklan Portal';
    $data['menu']  = 'iklan';

    return view('superadmin/manajemen_iklan', $data);
}
public function formEditIklan($id)
{
    $iklanModel = new \App\Models\IklanModel();

    $data = [
        'title' => 'Edit Iklan',
        'judul' => 'Edit Iklan',
        'menu'  => 'iklan',
        'iklan' => $iklanModel->find($id)
    ];

    return view('superadmin/edit_iklan', $data);
}
}