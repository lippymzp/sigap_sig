<?php

namespace App\Controllers;

class Pneumonia extends BaseController
{

    public function simpandatapasien()
    {
        $model = new \App\Models\InputDataPasienModel();

        // ambil semua data dari form
        $data = $this->request->getPost();

        // 🔥 panggil model (di sinilah insert terjadi)
        $success = $model->simpanSemua($data);

        // 🔥 respon hasil
        if ($success) {
            return redirect()->back()->with('success', 'Data pasien & wilayah berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
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
        public function skriningpneumonia3()
    {
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $kategori_usia = $this->request->getPost('kategori_usia');

    $kabupaten = $this->request->getPost('kabupaten');
    $kecamatan = $this->request->getPost('kecamatan');
    $kelurahan = $this->request->getPost('kelurahan');

    // ======================
    // SIMPAN pasien_skrining
    // ======================

 $modelPasien = new \App\Models\PasienPneumoniaModel();

$modelPasien->save([
    'nama_pasien_skrining' => $nama,
    'jenis_kelamin' => $jenis_kelamin,
    'tanggal_lahir' => $tanggal_lahir,
    'usia' => $kategori_usia,
    'alamat' => $kelurahan . ', ' . $kecamatan . ', ' . $kabupaten,
    'created_at' => date('Y-m-d H:i:s'),
    'id_wilayah' => 1
]);

    $id_pasien_skrining = $modelPasien->insertID();

    // ======================
    // HITUNG SKOR
    // ======================

            $totalSkor = 0;

        $reverse = [14, 15, 16, 17, 18, 19, 20];

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
    $p12 = ($this->request->getPost('p12') == 1) ? 'Iya' : 'Tidak';
    $p13 = ($this->request->getPost('p13') == 1) ? 'Iya' : 'Tidak';
    $p14 = ($this->request->getPost('p14') == 1) ? 'Iya' : 'Tidak';
    $p15 = ($this->request->getPost('p15') == 1) ? 'Iya' : 'Tidak';
    $p16 = ($this->request->getPost('p16') == 1) ? 'Iya' : 'Tidak';
    $p17 = ($this->request->getPost('p17') == 1) ? 'Iya' : 'Tidak';
    $p18 = ($this->request->getPost('p18') == 1) ? 'Iya' : 'Tidak';
    $p19 = ($this->request->getPost('p19') == 1) ? 'Iya' : 'Tidak';
    $p20 = ($this->request->getPost('p20') == 1) ? 'Iya' : 'Tidak';
    $p21 = ($this->request->getPost('p21') == 1) ? 'Iya' : 'Tidak';
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
        'var12' => $p12,
        'var13' => $p13,
        'var14' => $p14,
        'var15' => $p15,
        'var16' => $p16,
        'var17' => $p17,
        'var18' => $p18,
        'var19' => $p19,
        'var20' => $p20,
        'var21' => $p21,

        'hasil' => $hasil
    ]);

    $data = $this->request->getPost();
    $data['hasil'] = $hasil;
    $data['alasan'] = $alasan;
    $data['totalSkor'] = $totalSkor;
    return view('gol_c/skrining3', $data);
}

    public function export()
    {
        $pasien = session()->get('pasien') ?? [];

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_pasien.xls");

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
