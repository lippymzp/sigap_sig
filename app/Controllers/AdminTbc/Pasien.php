<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\PasienModel;

class Pasien extends BaseController
{
    protected PasienModel $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    // tampil data
    public function index()
    {
        $data = [
            'pasien' => $this->pasienModel->findAll(),
            'menu' => 'hasil',
            'judul' => 'Hasil Data Pasien'
        ];

        return view('gol_b/data-pasien/data_pasien', $data);
    }

        // form input
    public function create()
    {
        return view('gol_b/data-pasien/create', [
            'menu' => 'inputdata',
            'judul' => 'Input Data Pasien'
        ]);
    }

    // simpan data
    public function store()
    {
        $this->pasienModel->save([
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'no_rm' => $this->request->getPost('no_rm'),
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan'),
            'ctt_klinis' => $this->request->getPost('ctt_klinis'),
            'id_petugas' => 3
        ]);

        return redirect()->to('/tbc/hasil');
    }
    
       public function edit(int $id)
    {
        $data = [
            'pasien' => $this->pasienModel->find($id),
            'judul' => 'Edit Data Pasien',
            'menu' => 'hasil'
        ];

        return view('gol_b/data-pasien/edit', $data);
    }

    public function update(int $id)
    {
        $this->pasienModel->update($id, [
            'no_rm' => $this->request->getPost('no_rm'),
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan'),
            'ctt_klinis' => $this->request->getPost('ctt_klinis'),
        ]);

        return redirect()->to('/tbc/hasil');
    }

    public function delete(int $id)
    {
        $this->pasienModel->delete($id);

        return redirect()->to('/tbc/hasil');
}
}