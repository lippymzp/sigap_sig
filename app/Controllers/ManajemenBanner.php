<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BannerDbdModel;

class ManajemenBanner extends BaseController
{
    public function index()
{
    $bannerModel = new BannerDbdModel();

    $search = $this->request->getGet('search');
    $sort   = $this->request->getGet('sort');

    $builder = $bannerModel;

    // SEARCH
    if (!empty($search)) {
        $builder = $builder->like('judul_banner', $search);
    }

    // SORTING
    if ($sort == 'terbaru') {
        $builder = $builder->orderBy('id_manajemen_banner', 'DESC');
    } elseif ($sort == 'terlama') {
        $builder = $builder->orderBy('id_manajemen_banner', 'ASC');
    } elseif ($sort == 'aktif') {
        $builder = $builder->where('status_banner', 'publish');
    } elseif ($sort == 'draft') {
        $builder = $builder->where('status_banner', 'draft');
    } else {
        $builder = $builder->orderBy('urutan', 'ASC');
    }

    $data['banner'] = $builder->findAll();

    // STATUS AKTIF
    $data['publish'] = $bannerModel
        ->where('status_banner', 'publish')
        ->countAllResults();

    // STATUS DRAFT
    $data['draft'] = $bannerModel
        ->where('status_banner', 'draft')
        ->countAllResults();

    return view(
        'gol_a/bannerDbd/manajemen_banner',
        $data
    );

}
    // HALAMAN UPLOAD
    public function unggah()
    {
        return view(
            'gol_a/bannerDbd/unggah_banner'
        );
    }

    // SIMPAN BANNER
    public function simpan()
    {
        $bannerModel = new BannerDbdModel();

        $file =
        $this->request->getFile('gambar');

        if (!$file || !$file->isValid()) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gambar tidak valid'
                );
        }

        // NAMA RANDOM
        $namaFile =
        $file->getRandomName();

        // UPLOAD
        $file->move(
            ROOTPATH . 'public/uploads/banner',
            $namaFile
        );

        // URUTAN OTOMATIS
        $lastBanner =
        $bannerModel
        ->orderBy('urutan', 'DESC')
        ->first();

        $urutan = 1;

        if ($lastBanner) {

            $urutan =
            (int)$lastBanner['urutan'] + 1;
        }

        // SIMPAN DATABASE
       $bannerModel->save([

    'judul_banner' => $this->request->getPost('judul_banner'),

    'gambar' => $namaFile,

    'deskripsi' => $this->request->getPost('deskripsi'),

    'urutan' => $urutan,

    // default otomatis jika kosong
    'status_banner' => $this->request->getPost('status_banner')

    ]);

        return redirect()
            ->to('/bannerDbd')
            ->with(
                'success',
                'Banner berhasil ditambahkan'
            );
    }

    // DELETE
    public function delete(int $id)
    {
        $bannerModel = new BannerDbdModel();

        $banner =
        $bannerModel->find($id);

        if (!$banner) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Banner tidak ditemukan'
                );
        }

        // HAPUS FILE
        if (
            !empty($banner['gambar']) &&
            file_exists(
                ROOTPATH .
                'public/uploads/banner/' .
                $banner['gambar']
            )
        ) {

            unlink(
                ROOTPATH .
                'public/uploads/banner/' .
                $banner['gambar']
            );
        }

        // HAPUS DATABASE
        $bannerModel->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Banner berhasil dihapus'
            );
    }

    // HALAMAN EDIT
    public function edit(int $id)
    {
        $bannerModel = new BannerDbdModel();

        $data['banner'] =
        $bannerModel->find($id);

        if (!$data['banner']) {

            return redirect()
                ->to('/bannerDbd')
                ->with(
                    'error',
                    'Banner tidak ditemukan'
                );
        }

        return view(
            'gol_a/bannerDbd/unggah_banner',
            $data
        );
    }

    // UPDATE
    public function update(int $id)
    {
        $bannerModel = new BannerDbdModel();

        $banner =
        $bannerModel->find($id);

        if (!$banner) {

            return redirect()
                ->to('/bannerDbd')
                ->with(
                    'error',
                    'Banner tidak ditemukan'
                );
        }

        $data = [

            'judul_banner' =>
            $this->request->getPost('judul_banner'),

            'deskripsi' =>
            $this->request->getPost('deskripsi'),

            'status_banner' =>
            $this->request->getPost('status_banner'),

            'urutan' =>
            $this->request->getPost('urutan')

        ];

        // CEK GAMBAR BARU
        $file =
        $this->request->getFile('gambar');

        if ($file && $file->isValid()) {

            // HAPUS LAMA
            if (
                !empty($banner['gambar']) &&
                file_exists(
                    ROOTPATH .
                    'public/uploads/banner/' .
                    $banner['gambar']
                )
            ) {

                unlink(
                    ROOTPATH .
                    'public/uploads/banner/' .
                    $banner['gambar']
                );
            }

            // UPLOAD BARU
            $namaBaru =
            $file->getRandomName();

            $file->move(
                ROOTPATH .
                'public/uploads/banner',
                $namaBaru
            );

            $data['gambar'] =
            $namaBaru;
        }

        // UPDATE DATABASE
        $bannerModel->update($id, $data);

        return redirect()
            ->to('/bannerDbd')
            ->with(
                'success',
                'Banner berhasil diupdate'
            );
    }
    public function preview(int $id)
{
    $bannerModel = new BannerDbdModel();
    $banner = $bannerModel->find($id);


    if (!$banner) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_a/bannerDbd/preview', [
        'banner' => $banner
    ]);
}
}