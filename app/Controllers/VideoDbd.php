<?php

namespace App\Controllers;

use App\Models\VideoDbdModel;
use CodeIgniter\Controller;

class VideoDbd extends Controller
{

    // =========================
    // LIST VIDEO
    // =========================
    public function index()
    {
        $model = new VideoDbdModel();

        $video = $model->findAll();

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
            'judul'     => 'Kelola Video'

        ]);
    }


    // =========================
    // FILTER PUBLISH
    // =========================
    public function publish()
    {
        $model = new VideoDbdModel();

        $video = $model
            ->where('status_video', 'publish')
            ->findAll();

        return view('gol_a/video/kelola_video', [

            'video'     => $video,
            'total'     => count($video),
            'publish'   => count($video),
            'draft'     => 0,
            'judul'     => 'Kelola Video'

        ]);
    }


    // =========================
    // FILTER DRAFT
    // =========================
    public function draft()
    {
        $model = new VideoDbdModel();

        $video = $model
            ->where('status_video', 'draft')
            ->findAll();

        return view('gol_a/video/kelola_video', [

            'video'     => $video,
            'total'     => count($video),
            'publish'   => 0,
            'draft'     => count($video),
            'judul'     => 'Kelola Video'

        ]);
    }


    // =========================
    // DETAIL VIDEO
    // =========================
    public function view(int $id)
    {
        $model = new VideoDbdModel();

        $video = $model->find($id);

        if (!$video) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Video tidak ditemukan'
            );
        }

        return view('gol_a/video/detail', [

            'video' => $video,
            'judul' => 'Kelola Video'

        ]);
    }


    // =========================
    // STEP 1
    // =========================
    public function tambah()
    {
        return view('gol_a/video/tambah1', [

            'judul' => 'Kelola Video'

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
    return view('gol_a/video/tambah2');
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

        return view('gol_a/video/tambah2', [

            'video'   => $video,
            'file'    => $video['file_video'],
            'is_edit' => true,
            'judul'   => 'Edit Video'

        ]);
    }
}


    // =========================
    // SIMPAN DETAIL
    // =========================
    public function simpanDetail()
    {
        $model = new VideoDbdModel();

        $file = session()->get('video_temp');

        if (!$file) {

            return redirect()->to('/video/tambah')
                ->with('error', 'Video belum diupload');
        }

        $model->save([

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