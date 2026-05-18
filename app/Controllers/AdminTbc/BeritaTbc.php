<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\BeritaTbcModel;

class BeritaTbc extends BaseController
{
public function index()
{
    $model = new BeritaTbcModel();

    $status = $this->request->getGet('status') ?? 'Publish';

    $total = (clone $model)
        ->where('id_penyakit', 2)
        ->countAllResults();

    $publish = (clone $model)
        ->where('id_penyakit', 2)
        ->where('status_berita', 'Publish')
        ->countAllResults();

    $draft = (clone $model)
        ->where('id_penyakit', 2)
        ->where('status_berita', 'Draft')
        ->countAllResults();

    $arsip = (clone $model)
        ->where('id_penyakit', 2)
        ->where('status_berita', 'Arsip')
        ->countAllResults();

    $berita = (clone $model)
        ->where('id_penyakit', 2)
        ->where('status_berita', $status)
        ->orderBy('id_berita', 'DESC')
        ->findAll();

    return view('gol_b/berita', [
        'menu'    => 'berita',
        'judul'   => 'Kelola Berita',
        'total'   => $total,
        'publish' => $publish,
        'draft'   => $draft,
        'arsip'   => $arsip,
        'status'  => $status,
        'berita'  => $berita
    ]);
}

    public function create()
    {
        return view('gol_b/admin/berita/create', [
            'menu'  => 'berita',
            'judul' => 'Unggah Berita'
        ]);
    }

    public function kutip()
{
    return view('gol_b/admin/berita/kutip', [
        'menu'  => 'berita',
        'judul' => 'Kutip Berita'
    ]);
}

public function simpan()
{
    $model = new BeritaTbcModel();

    $file = $this->request->getFile('gambar');

    $namaGambar = 'default.jpg';

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $namaGambar = $file->getRandomName();

        $file->move('uploads/berita/', $namaGambar);
    }

    $isi = $this->request->getPost('isi');

    if (is_array($isi)) {
        $isi = implode('', $isi);
    }

    $model->insert([

        'id_petugas'       => session()->get('id_petugas') ?? 1,

        'id_penyakit'      => 2,

        'judul_berita'     => $this->request->getPost('judul'),

        'deskripsi_berita' => $isi,

        'url_berita'       => null,

        'gambar_berita'    => $namaGambar,

        'tanggal_berita'   => $this->request->getPost('tanggal'),

        'status_berita'    => $this->request->getPost('status') ?: 'Publish'
    ]);

    return redirect()->to('/tbc/berita');
}

   public function simpanKutip()
{
    $model = new BeritaTbcModel();

    $link = $this->request->getPost('link');
    $status = $this->request->getPost('status') ?? 'Draft';

    $meta = $this->getMetaData($link);

    if (!$meta) {
        $meta = [
            'title' => 'Berita Eksternal',
            'description' => 'Kutip berita luar',
            'image' => ''
        ];
    }

    $judul = !empty($meta['title'])
            ? trim($meta['title'])
            : 'Berita Eksternal';
    $deskripsi = !empty($meta['description'])
                ? strip_tags(trim($meta['description']))
                : 'Kutip berita luar';

    $namaGambar = 'default.jpg';

    if (!empty($meta['image'])) {

        try {

            $imageContent = @file_get_contents($meta['image']);

            if ($imageContent !== false) {

                $ext = pathinfo(
                    parse_url($meta['image'], PHP_URL_PATH),
                    PATHINFO_EXTENSION
                );

                if (empty($ext)) {
                    $ext = 'jpg';
                }

                $namaGambar = uniqid() . '.' . $ext;

                @file_put_contents(
                    FCPATH . 'uploads/berita/' . $namaGambar,
                    $imageContent
                );
            }

        } catch (\Throwable $e) {

            $namaGambar = 'default.jpg';

        }
    }

    $model->insert([
    'id_petugas'       => session()->get('id_petugas') ?? 1,
    'id_penyakit'      => 2,

    'judul_berita'     => !empty($judul)
                            ? $judul
                            : 'Berita Eksternal',

    'deskripsi_berita' => !empty($deskripsi)
                            ? $deskripsi
                            : 'Kutip berita luar',

    'url_berita'       => $link,

    'gambar_berita'    => $namaGambar,

    'tanggal_berita'   => date('Y-m-d'),

    'status_berita'    => $status
]);

    return redirect()->to('/tbc/berita');
}

    public function hapus(int $id)
    {
        $model = new BeritaTbcModel();
        $cek = $model
    ->where('id_penyakit', 2)
    ->find($id);

if ($cek) {
    $model->delete($id);
}

        return redirect()->to('/tbc/berita');
    }

    public function arsip(int $id)
    {
        $model = new BeritaTbcModel();

$cek = $model
    ->where('id_penyakit', 2)
    ->find($id);

if ($cek) {

    $model->update($id, [
        'status_berita' => 'Draft'
    ]);

}

        return redirect()->to('/tbc/berita?status=Draft');
    }

public function publish(int $id)
{
    $model = new BeritaTbcModel();

    $cek = $model
        ->where('id_penyakit', 2)
        ->find($id);

    if ($cek) {

        $model->update($id, [
            'status_berita' => 'Publish'
        ]);

    }

    return redirect()->to('/tbc/berita');
}

public function detail($id)
{
    $model = new BeritaTbcModel();

    $berita = $model
    ->where('id_penyakit', 2)
    ->find($id);

    if (!$berita) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // JIKA BERITA EKSTERNAL
    if (!empty($berita['url_berita'])) {

        return redirect()->to((string)$berita['url_berita']);

    }

    // JIKA BERITA INTERNAL
    return view('gol_b/admin/berita/detail', [
        'menu'   => 'berita',
        'judul'  => $berita['judul_berita'],
        'berita' => $berita
    ]);
}

public function edit(int $id)
{
    $model = new BeritaTbcModel();

    $berita = $model
    ->where('id_penyakit', 2)
    ->find($id);

    // DETEKSI BERITA EKSTERNAL
    if (
        !empty($berita['url_berita']) &&
        $this->request->getGet('mode') != 'link'
    ) {

        return redirect()->to(
            base_url('tbc/berita/edit/'.$id.'?mode=link')
        );
    }

    return view('gol_b/admin/berita/edit', [
        'menu'   => 'berita',
        'judul'  => 'Edit Berita',
        'berita' => $berita
    ]);
}
    public function update(int $id)
{
    $model = new BeritaTbcModel();

    $lama = $model
        ->where('id_penyakit', 2)
        ->find($id);

    if (!$lama) {
        return redirect()->to('/tbc/berita');
    }

    $link = $this->request->getPost('link');
    $isi  = $this->request->getPost('isi');

    // kalau berita luar
    if (!empty($link)) {

    $meta = $this->getMetaData($link);

$data = [
    'judul_berita' => !empty($this->request->getPost('judul'))
                        ? $this->request->getPost('judul')
                        : ($meta['title'] ?? 'Berita Eksternal'),

    'deskripsi_berita' => !empty($lama['deskripsi_berita'])
                            ? $lama['deskripsi_berita']
                            : ($meta['description'] ?? 'Kutip berita luar'),

    'url_berita' => $link,

    'tanggal_berita' => !empty($lama['tanggal_berita'])
                            ? $lama['tanggal_berita']
                            : date('Y-m-d')
];

    } else {

        // kalau berita biasa
        if (is_array($isi)) {
            $isi = implode('', $isi);
        }

        $data = [
            'judul_berita'     => $this->request->getPost('judul'),
            'deskripsi_berita' => $isi,
            'tanggal_berita'   => $this->request->getPost('tanggal')
        ];
    }

    // upload gambar baru
    $file = $this->request->getFile('gambar');

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $nama = $file->getRandomName();

        $file->move('uploads/berita/', $nama);

        $data['gambar_berita'] = $nama;
    }

    $model
    ->where('id_penyakit', 2)
    ->update($id, $data);

    return redirect()->to('/tbc/berita');
}

private function getMetaData(string $url)
{
    try {

        $context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0\r\n"
    ]
]);

$html = @file_get_contents($url, false, $context);

        if (!$html) {
            return null;
        }

        libxml_use_internal_errors(true);

        $doc = new \DOMDocument();

        $doc->loadHTML($html);

        $xpath = new \DOMXPath($doc);

        $title = '';
        $description = '';
        $image = '';

        // ambil title
        $titleTag = $doc->getElementsByTagName('title');

        if ($titleTag->length > 0) {

    $title = trim($titleTag->item(0)->nodeValue);

}

        // ambil meta
        $metaTags = $xpath->query("//meta");

        foreach ($metaTags as $meta) {
           /** @var \DOMElement $meta */
            $property = strtolower($meta->getAttribute('property'));
            $name     = strtolower($meta->getAttribute('name'));

            $content  = $meta->getAttribute('content');

            if (
                $name == 'description' ||
                $property == 'og:description'
            ) {
                $description = $content;
            }

            if (
    $property == 'og:title' ||
    $name == 'og:title'
) {
    $title = trim($content);
}

            if (
                $property == 'og:image' ||
                $name == 'og:image'
            ) {
                $image = $content;
            }
        }

        return [
            'title'       => $title,
            'description' => $description,
            'image'       => $image
        ];

    } catch (\Throwable $e) {

        return null;

    }
}

}