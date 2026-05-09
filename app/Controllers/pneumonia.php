<?php

namespace App\Controllers;

use App\Models\InputDataPasienModel;
use App\Models\wilayahskriningpneumonia;
use App\Models\PasienPneumoniaModel;
use App\Models\SkriningPneumoniaModel;

class Pneumonia extends BaseController
{

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

    public function skriningpneumonia3()
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
        $kelurahan = $this->request->getPost('kelurahan');

        /*
        =====================================
        VALIDASI
        =====================================
        */

        if (
            empty($provinsi) ||
            empty($kabupaten) ||
            empty($kecamatan) ||
            empty($kelurahan)
        ) {

            return redirect()
                ->to('/skriningpneumonia')
                ->with('error', 'Data wilayah wajib diisi');
        }

        /*
        =====================================
        SIMPAN WILAYAH
        =====================================
        */

        $modelWilayah = new wilayahskriningpneumonia();

        $modelWilayah->save([
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'rt' => 0,
            'rw' => 0,
            'alamat_lengkap' =>
                $kelurahan . ', ' .
                $kecamatan . ', ' .
                $kabupaten
        ]);

        $id_wilayah = $modelWilayah->insertID();

        /*
        =====================================
        SIMPAN PASIEN
        =====================================
        */

        $modelPasien = new PasienPneumoniaModel();

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

        $id_pasien_skrining =
            $modelPasien->insertID();

        /*
        =====================================
        INPUT USER
        =====================================
        */

        $input = [];

        for ($i = 1; $i <= 11; $i++) {

            $input["var$i"] =
                ($this->request->getPost("p$i") == 1)
                ? 'iya'
                : 'tidak';
        }

        /*
        =====================================
        LOAD DATASET CSV
        =====================================
        */

        $dataset = $this->loadCSV();

        /*
        =====================================
        ATRIBUT
        =====================================
        */

        $attributes = [
            'batuk',
            'dahak',
            'sesak',
            'nyeri_dada',
            'mual',
            'lemas',
            'nafsu_makan',
            'demam',
            'napas_cepat',
            'dahak_dada',
            'mengi'
        ];

        /*
        =====================================
        BUILD TREE C4.5
        =====================================
        */

        $tree = $this->buildTree(
            $dataset,
            $attributes
        );

        /*
        =====================================
        MAPPING INPUT
        =====================================
        */

        $mapping = [
            'batuk' => $input['var1'],
            'dahak' => $input['var2'],
            'sesak' => $input['var3'],
            'nyeri_dada' => $input['var4'],
            'mual' => $input['var5'],
            'lemas' => $input['var6'],
            'nafsu_makan' => $input['var7'],
            'demam' => $input['var8'],
            'napas_cepat' => $input['var9'],
            'dahak_dada' => $input['var10'],
            'mengi' => $input['var11']
        ];

        /*
        =====================================
        PREDIKSI
        =====================================
        */

        $hasilPrediksi = $this->predict(
            $tree,
            $mapping
        );

        /*
        =====================================
        HASIL
        =====================================
        */

        if ($hasilPrediksi == 'positif') {

            $hasil =
                'Risiko Pneumonia';

            $alasan =
                'Hasil klasifikasi algoritma C4.5 menunjukkan risiko pneumonia.';

        } else {

            $hasil =
                'Tidak Risiko Pneumonia';

            $alasan =
                'Hasil klasifikasi algoritma C4.5 menunjukkan tidak berisiko pneumonia.';
        }

        /*
        =====================================
        KONVERSI JAWABAN
        =====================================
        */

        $jawaban = [];

        for ($i = 1; $i <= 11; $i++) {

            $jawaban[$i] =
                ($this->request->getPost("p$i") == 1)
                ? 'Iya'
                : 'Tidak';
        }

        /*
        =====================================
        SIMPAN SKRINING
        =====================================
        */

        $modelSkrining =
            new SkriningPneumoniaModel();

        $modelSkrining->save([

            'id_pasien_skrining' =>
                $id_pasien_skrining,

            'id_penyakit' => 3,

            'tanggal' => date('Y-m-d'),

            'var1' => $jawaban[1],
            'var2' => $jawaban[2],
            'var3' => $jawaban[3],
            'var4' => $jawaban[4],
            'var5' => $jawaban[5],
            'var6' => $jawaban[6],
            'var7' => $jawaban[7],
            'var8' => $jawaban[8],
            'var9' => $jawaban[9],
            'var10' => $jawaban[10],
            'var11' => $jawaban[11],

            'hasil' => $hasil
        ]);

        /*
        =====================================
        KIRIM KE VIEW
        =====================================
        */

        $data = $this->request->getPost();

        $data['provinsi'] = $provinsi;
        $data['kabupaten'] = $kabupaten;
        $data['kecamatan'] = $kecamatan;

        $data['hasil'] = $hasil;
        $data['alasan'] = $alasan;

        return view(
            'gol_c/skrining3',
            $data
        );
    }

    /*
    =====================================
    LOAD CSV
    =====================================
    */

    private function loadCSV()
{
    $file = ROOTPATH . 'public/dataset/pneumonia.csv';

    $rows = array_map('str_getcsv', file($file));

    $header = array_shift($rows);

    $dataset = [];

    foreach ($rows as $row) {

        $data = array_combine($header, $row);

        // normalisasi semua value
        foreach ($data as $key => $value) {

            $data[$key] = strtolower(trim($value));
        }

        $dataset[] = $data;
    }

    return $dataset;
}

    /*
    =====================================
    ENTROPY
    =====================================
    */

    private function entropy($dataset)
    {
        $total = count($dataset);

        if ($total == 0) {
            return 0;
        }

        $positif = 0;
        $negatif = 0;

        foreach ($dataset as $row) {

            if ($row['hasil'] == 'positif') {
                $positif++;
            } else {
                $negatif++;
            }
        }

        $pPos = $positif / $total;
        $pNeg = $negatif / $total;

        $entropy = 0;

        if ($pPos > 0) {
            $entropy -=
                $pPos * log($pPos, 2);
        }

        if ($pNeg > 0) {
            $entropy -=
                $pNeg * log($pNeg, 2);
        }

        return $entropy;
    }

    /*
    =====================================
    GAIN
    =====================================
    */

    private function gain(
        $dataset,
        $attribute
    )
    {
        $totalEntropy =
            $this->entropy($dataset);

        $values = ['iya', 'tidak'];

        $weightedEntropy = 0;

        foreach ($values as $value) {

            $subset =
                array_filter(
                    $dataset,
                    function($row)
                    use ($attribute, $value) {

                        return
                            $row[$attribute]
                            == $value;
                    }
                );

            $subsetCount = count($subset);

            if ($subsetCount == 0) {
                continue;
            }

            $weightedEntropy +=
                ($subsetCount / count($dataset))
                *
                $this->entropy($subset);
        }

        return
            $totalEntropy
            -
            $weightedEntropy;
    }

    /*
    =====================================
    MAJORITY CLASS
    =====================================
    */

    private function majorityClass($dataset)
    {
        $positif = 0;
        $negatif = 0;

        foreach ($dataset as $row) {

            if ($row['hasil'] == 'positif') {
                $positif++;
            } else {
                $negatif++;
            }
        }

        return
            ($positif >= $negatif)
            ? 'positif'
            : 'negatif';
    }

    /*
    =====================================
    BUILD TREE
    =====================================
    */

    private function buildTree(
        $dataset,
        $attributes
    )
    {

        $classes =
            array_unique(
                array_column(
                    $dataset,
                    'hasil'
                )
            );

        /*
        semua class sama
        */

        if (count($classes) == 1) {
            return $classes[0];
        }

        /*
        atribut habis
        */

        if (empty($attributes)) {

            return
                $this->majorityClass(
                    $dataset
                );
        }

        /*
        cari gain terbesar
        */

        $bestGain = -1;
        $bestAttribute = null;

        foreach ($attributes as $attribute) {

            $gain =
                $this->gain(
                    $dataset,
                    $attribute
                );

            if ($gain > $bestGain) {

                $bestGain = $gain;
                $bestAttribute = $attribute;
            }
        }

        $tree = [
            'attribute' => $bestAttribute,
            'nodes' => []
        ];

        foreach (['iya', 'tidak'] as $value) {

            $subset =
                array_filter(
                    $dataset,
                    function($row)
                    use ($bestAttribute, $value) {

                        return
                            $row[$bestAttribute]
                            == $value;
                    }
                );

            if (empty($subset)) {

                $tree['nodes'][$value] =
                    $this->majorityClass(
                        $dataset
                    );

            } else {

                $remaining =
                    array_diff(
                        $attributes,
                        [$bestAttribute]
                    );

                $tree['nodes'][$value] =
                    $this->buildTree(
                        array_values($subset),
                        $remaining
                    );
            }
        }

        return $tree;
    }

    /*
    =====================================
    PREDICT
    =====================================
    */

    private function predict(
        $tree,
        $input
    )
    {

        if (is_string($tree)) {
            return $tree;
        }

        $attribute =
            $tree['attribute'];

        $value =
            $input[$attribute];

        if (
            !isset(
                $tree['nodes'][$value]
            )
        ) {

            return 'negatif';
        }

        return $this->predict(
            $tree['nodes'][$value],
            $input
        );
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