<?php

namespace App\Controllers;

use App\Models\IklanModel;
use App\Models\SuperAdmin as SuperAdminModel;

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



    //Manajemen Puskesmas
   public function index()
{
    $userModel = new SuperAdminModel();

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
        $userModel = $userModel->search($keyword);
    }

    $perPage = 10;
    $currentPage = $this->request->getVar('page') ?? 1;

    $data = [
        'users' => $userModel->paginate($perPage, 'default'),
        'pager' => $userModel->pager,
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'keyword' => $keyword,
        'menu' => 'puskesmas', // <--- tambahkan ini
    ];

    return view('superadmin/manajemen_puskesmas', $data);
}

  public function puskesmas()
{
    $userModel = new SuperAdminModel();

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
        $userModel = $userModel->search($keyword);
    }

    $perPage = 10;
    $currentPage = $this->request->getVar('page') ?? 1;

    $data = [
        'users' => $userModel->paginate($perPage, 'default'),
        'pager' => $userModel->pager,
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'keyword' => $keyword,
        'menu' => 'puskesmas', // <--- tambahkan ini
    ];

    return view('superadmin/manajemen_puskesmas', $data);
}

public function store()
{
    $userModel = new SuperAdminModel(); // atau model usermu

    $userModel->save([
        'role'      => $this->request->getPost('role'),
        'puskesmas' => $this->request->getPost('puskesmas'),
        'username'  => $this->request->getPost('username'),
        'email'     => $this->request->getPost('email'),
        'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ]);

    return redirect()->to('/superadmin-user')->with('success', 'User berhasil ditambahkan');
}

public function create()
{
    return view('superadmin/create_pkm', [  // <-- ganti nama view di sini
        'judul' => 'Tambah User',
        'menu' => 'admin'
    ]);
}

}
