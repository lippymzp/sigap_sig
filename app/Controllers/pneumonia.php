<?php

namespace App\Controllers;

use App\Models\InputDataPasienModel;
use App\Models\wilayahskriningpneumonia;
use App\Models\PasienPneumoniaModel;
use App\Models\SkriningPneumoniaModel;

class Pneumonia extends BaseController
{

    public function inputData()
    {
        return view('gol_c/input_data', [
            'menu' => 'inputdata',
            'penyakit' => 'pneumonia',
            'judul' => 'Input Data Pasien'
        ]);
    }

    public function hasil_data()
    {
        $pasien = session()->get('pasien') ?? [];

        return view('gol_c/hasil_data_pasien/hasil_data_c', [
            'menu' => 'hasil',
            'penyakit' => 'pneumonia',
            'judul' => 'Hasil Data Pasien',
            'pasien' => $pasien
        ]);
    }

    public function simpandatapasien()
    {
        $model = new InputDataPasienModel();

        $data = [

            // ======================
            // DATA WILAYAH
            // ======================

            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa' => $this->request->getPost('desa'),

            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw'),

            'alamat' => $this->request->getPost('alamat'),

            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng'),

            // ======================
            // DATA PASIEN
            // ======================

            'nama' => $this->request->getPost('nama'),

            'tanggal' => $this->request->getPost('tanggal'),

            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),

            'usia' => $this->request->getPost('usia'),

            'catatan' => $this->request->getPost('catatan'),
        ];

        $simpan = $model->simpanSemua($data);

        if ($simpan) {

            return redirect()
                ->back()
                ->with('success', 'Data pasien berhasil disimpan');

        } else {

            return redirect()
                ->back()
                ->with('error', 'Data gagal disimpan');
        }
    }

    public function skriningpneumonia()
    {
        return view('gol_c/skrining1');
    }

    public function skriningpneumonia2()
    {
        $data = $this->request->getPost();

        return view('gol_c/skrining2', $data);
    }

    public function skriningdbd3()
    {
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $kategori_usia = $this->request->getPost('kategori_usia');
    $nik = $this->request->getPost('nik');
    $telepon = $this->request->getPost('telepon');
   $provinsi = $this->request->getPost('provinsi_nama');
$kabupaten = $this->request->getPost('kabupaten_nama');
$kecamatan = $this->request->getPost('kecamatan_nama');
$kelurahan = $this->request->getPost('kelurahan'); // ini sudah nama
if (empty($provinsi) || empty($kabupaten) || empty($kecamatan) || empty($kelurahan)) {
    return redirect()->to('/skriningpneumonia')->with('error', 'Data wilayah wajib diisi');
}

    // ======================
    // SIMPAN pasien_skrining
    // ======================
$modelWilayah = new \App\Models\wilayahskriningpneumonia();

$modelWilayah->save([
     'provinsi' => $provinsi ?? '-',
    'kabupaten' => $kabupaten ?? '-',
    'kecamatan' => $kecamatan ?? '-',
    'kelurahan' => $kelurahan ?? '-',
    'rt' => 0,
    'rw' => 0,
    'alamat_lengkap' => $kelurahan . ', ' . $kecamatan . ', ' . $kabupaten
    
]);

$id_wilayah = $modelWilayah->insertID();

 $modelPasien = new \App\Models\PasienPneumoniaModel();

$modelPasien->save([
    'nik' => $nik,
    'nama_pasien_skrining' => $nama,
    'jenis_kelamin' => $jenis_kelamin,
    'tanggal_lahir' => $tanggal_lahir,
    'usia' => $kategori_usia,
    'no_hp' => $telepon,
    'created_at' => date('Y-m-d H:i:s'),
    'id_wilayah' => $id_wilayah
]);

    $id_pasien_skrining = $modelPasien->insertID();

    // ======================
    // HITUNG SKOR
    // ======================

            $totalSkor = 0;

        $reverse = [14, 15, 16, 17, 18, 19, 20, 21];

        for ($i = 1; $i <= 21; $i++) {
            $nilai = $this->request->getPost("p".$i) ?? 0;

            if (in_array($i, $reverse)) {
                $nilai = ($nilai == 1) ? 0 : 1;
            }

            $totalSkor += $nilai;
        }

        if ($totalSkor >= 0 && $totalSkor <= 6) {
            $hasil = "Kategori Lingkungan Buruk";
            $alasan = "Skor Anda: $totalSkor (0 - 6)";
        }
        elseif ($totalSkor >= 7 && $totalSkor <= 13) {
            $hasil = "Kategori Lingkungan Cukup";
            $alasan = "Skor Anda: $totalSkor (7 - 13)";
        }
        else {
            $hasil = "Kategori Lingkungan Baik";
            $alasan = "Skor Anda: $totalSkor (14 - 21)";
        }

    // ======================
    // SIMPAN tabel skrining
    // ======================

    $modelSkrining = new \App\Models\SkriningPneumoniaModel();
    $p1 = ($this->request->getPost('p1') == 1) ? 'Iya' : 'Tidak';
    $p2 = ($this->request->getPost('p2') == 1) ? 'Iya' : 'Tidak';
    $p3 = ($this->request->getPost('p3') == 1) ? 'Iya' : 'Tidak';
    $p4 = ($this->request->getPost('p4') == 1) ? 'Iya' : 'Tidak';
    $p5 = ($this->request->getPost('p5') == 1) ? 'Iya' : 'Tidak';
    $p6 = ($this->request->getPost('p6') == 1) ? 'Iya' : 'Tidak';
    $p7 = ($this->request->getPost('p7') == 1) ? 'Iya' : 'Tidak';
    $p8 = ($this->request->getPost('p8') == 1) ? 'Iya' : 'Tidak';
    $p9 = ($this->request->getPost('p9') == 1) ? 'Iya' : 'Tidak';
    $p10 = ($this->request->getPost('p10') == 1) ? 'Iya' : 'Tidak';
    $p11 = ($this->request->getPost('p11') == 1) ? 'Iya' : 'Tidak';
    
    $modelSkrining->save([
        'id_pasien_skrining' => $id_pasien_skrining,
        'id_penyakit' => 1,
        'tanggal' => date('Y-m-d'),

        'var1' => $p1,
        'var2' => $p2,
        'var3' => $p3,
        'var4' => $p4,
        'var5' => $p5,
        'var6' => $p6,
        'var7' => $p7,
        'var8' => $p8,
        'var9' => $p9,
        'var10' => $p10,
        'var11' => $p11,
        

        'hasil' => $hasil
    ]);

   $data = $this->request->getPost();
$data['provinsi']  = $provinsi;   // sudah berisi nama
$data['kabupaten'] = $kabupaten;
$data['kecamatan'] = $kecamatan;
$data['hasil']     = $hasil;
$data['alasan']    = $alasan;
$data['totalSkor'] = $totalSkor;
return view('gol_c/skrining3', $data);
}
    

   
    public function export()
    {
        $pasien =
            session()->get('pasien') ?? [];

        header(
            "Content-Type: application/vnd.ms-excel"
        );

        header(
            "Content-Disposition: attachment; filename=data_pasien.xls"
        );

        echo "<table border='1'>";

        echo "<tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Kasus</th>
              </tr>";

        $no = 1;

        foreach ($pasien as $p) {

            echo "<tr>
                    <td>{$no}</td>
                    <td>{$p['kecamatan']}</td>
                    <td>{$p['desa']}</td>
                    <td>{$p['jk']}</td>
                    <td>{$p['usia']}</td>
                    <td>1</td>
                  </tr>";

            $no++;
        }

        echo "</table>";
    }
}