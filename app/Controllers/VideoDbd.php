<?php

namespace App\Controllers;

use App\Models\VideoDbdModel;
use App\Models\PetugasModel;
use CodeIgniter\Controller;

class VideoDbd extends Controller
{

    // =========================
    // LIST VIDEO
    // =========================
    public function index()
    {
        $model = new VideoDbdModel();
        $petugasModel = new PetugasModel();

        // ambil id petugas dari session
        $id_petugas = session()->get('id_petugas');

        // ambil data petugas
        $petugas = $petugasModel->find($id_petugas);

        // ambil id penyakit
        $id_penyakit = $petugas['id_penyakit'];

        // hanya tampilkan video sesuai penyakit
        $video = $model
            ->where('id_penyakit', $id_penyakit)
            ->findAll();

        $publish = 0;
        $draft = 0;

        foreach ($video as $v) {

            if (($v['status_video'] ?? '') === 'publish') {

                $publish++;

            } else {

                $draft++;
            }
        }

        return view('gol_a/video/kelola_video', [

            'video'     => $video,
            'total'     => count($video),
            'publish'   => $publish,
            'draft'     => $draft,
            'title'     => 'Video',
            'judul'     => 'Video'

        ]);
    }


    // =========================
    // FILTER PUBLISH
    // =========================
    public function publish()
    {
        $model = new VideoDbdModel();
        $petugasModel = new PetugasModel();
        $id_petugas = session()->get('id_petugas');
        $petugas = $petugasModel->find($id_petugas);
        $id_penyakit = $petugas['id_penyakit'];

        $video = $model
            ->where('id_penyakit', $id_penyakit)
            ->where('status_video', 'publish')
            ->findAll();

        return view('gol_a/video/kelola_video', [

            'video'     => $video,
            'total'     => count($video),
            'publish'   => count($video),
            'draft'     => 0,
            'title'     => 'Video',
            'judul'     => 'Video'

        ]);
    }


    // =========================
    // FILTER DRAFT
    // =========================
    public function draft()
    {
        $model = new VideoDbdModel();
        $petugasModel = new PetugasModel();

        $id_petugas = session()->get('id_petugas');
    
        $petugas = $petugasModel->find($id_petugas);
    
        $id_penyakit = $petugas['id_penyakit'];
    
        $video = $model
            ->where('id_penyakit', $id_penyakit)
            ->where('status_video', 'draft')
            ->findAll();

        return view('gol_a/video/kelola_video', [

            'video'     => $video,
            'total'     => count($video),
            'publish'   => 0,
            'draft'     => count($video),
            'title'     => 'Video',
            'judul'     => 'Video'
        ]);
    }


    // =========================
    // DETAIL VIDEO
    // =========================
public function view($id = null)
{
    // kalau id kosong
    if ($id == null) {

        return redirect()->to('/video/list_video');
    }

    $model = new VideoDbdModel();

    // ambil data video berdasarkan id
    $video = $model
        ->where('id_video', $id)
        ->where('id_penyakit', 1)
        ->where('status_video', 'publish')
        ->first();

    // kalau video tidak ditemukan
    if (!$video) {

        throw new \CodeIgniter\Exceptions\PageNotFoundException(
            'Video tidak ditemukan'
        );
    }

    // =========================
    // SIMPAN HISTORY DITONTON
    // =========================
    $watched = session()->get('watched_video');

    if (!is_array($watched)) {
        $watched = [];
    }

    // tambahkan id video kalau belum ada
    if (!in_array($id, $watched)) {

        $watched[] = $id;

        session()->set('watched_video', $watched);
    }

    // =========================
    // REKOMENDASI VIDEO
    // =========================
    $rekomendasi = $model
        ->where('id_video !=', $id)
        ->where('id_penyakit', 1)
        ->where('status_video', 'publish')
        ->findAll(10);

    // tampilkan view
    return view('gol_a/video/video_dbd', [

        'video' => $video,
        'rekomendasi' => $rekomendasi,
        'title' => 'Video',
        'judul'     => 'Video'

    ]);
}


    // =========================
    // STEP 1
    // =========================
    public function tambah1()
{
    if (!session()->get('from_edit')) {
        session()->remove('edit_video');
        session()->remove('video_temp');
    }

    $video = session()->get('edit_video');

    session()->remove('from_edit');

    return view('gol_a/video/tambah1', [
        'title'   => 'Video',
        'video'   => $video,
        'is_edit' => !empty($video)
    ]);
}


    // =========================
    // SIMPAN VIDEO STEP 1
    // =========================
    public function simpan()
    {
        $file = $this->request->getFile('file_video');

        if (!$file || !$file->isValid()) {

            return redirect()->back()
                ->with('error', 'File tidak valid');
        }

        // nama random
        $namaFile = $file->getRandomName();

        // upload ke public/uploads/video
        $file->move(
            ROOTPATH . 'public/uploads/video',
            $namaFile
        );

        // simpan session
        session()->set('video_temp', $namaFile);

        // redirect ke step 2
        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    public function tambah2()
{
    $video = session()->get('edit_video');

    return view('gol_a/video/tambah2', [
        'video'   => $video,
        'is_edit' => !empty($video),
        'title'   => 'Video',
        'judul'   => 'Video'
    ]);
}

    // =========================
    // STEP 2
    // =========================
    public function edit(?int $id = null)
{
    $model = new VideoDbdModel();

    // MODE EDIT
    if ($id != null) {

        $video = $model->find($id);

        if (!$video) {

            return redirect()->to('/video')
                ->with('error', 'Video tidak ditemukan');
        }
        // simpan data lama ke session
            session()->set('edit_video', $video);
            session()->set('video_temp', $video['file_video']);
            session()->set('from_edit', true);

            return redirect()->to('/video/tambah1');
    }
}


    // =========================
    // SIMPAN DETAIL
    // =========================
    public function simpanDetail()
    {
        $model = new VideoDbdModel();
        $petugasModel = new PetugasModel();

        $file = session()->get('video_temp');

        if (!$file) {

            return redirect()->to('/video/tambah')
                ->with('error', 'Video belum diupload');
        }
        // ambil id petugas dari session
        $id_petugas = session()->get('id_petugas');

        // ambil data petugas
        $petugas = $petugasModel->find($id_petugas);

        // ambil id penyakit
        $id_penyakit = $petugas['id_penyakit'];

        $editVideo = session()->get('edit_video');

        $model->save([
            'id_video'         => $editVideo['id_video'] ?? null,
            'id_petugas'       => $id_petugas,
            'id_penyakit'      => $id_penyakit,
            'judul_video'      => $this->request->getPost('judul_video'),
            'deskripsi_video'  => $this->request->getPost('deskripsi_video'),
            'file_video'       => $file,
            'status_video'     => $this->request->getPost('status_video') ?? 'draft'

        ]);

        // hapus session
        session()->remove('video_temp');

        return redirect()->to('/video')
            ->with('success', 'Video berhasil disimpan');
    }


    // =========================
    // DELETE
    // =========================
    public function delete(int $id)
    {
        $model = new VideoDbdModel();

        $video = $model->find($id);

        if (!$video) {

            return redirect()->to('/video')
                ->with('error', 'Data tidak ditemukan');
        }

        // hapus file video
        if (
            !empty($video['file_video']) &&
            file_exists(
                ROOTPATH . 'public/uploads/video/' . $video['file_video']
            )
        ) {

            unlink(
                ROOTPATH . 'public/uploads/video/' . $video['file_video']
            );
        }

        $model->delete($id);

        return redirect()->to('/video')
            ->with('success', 'Video berhasil dihapus');
    }
}