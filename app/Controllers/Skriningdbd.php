<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InputDataPasienModel;
use App\Models\WilayahSkriningDbdModel;
use App\Models\PasienSkriningdbdModel;
use App\Models\SkriningdbdModel;

class Skriningdbd extends BaseController
{
    public function skriningdbd()
    {
        return view('gol_a/skrining1');
    }

    public function skriningdbd2()
    {
        $data = $this->request->getPost();
        return view('gol_a/skrining2', $data);
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
        $kelurahan = $this->request->getPost('kelurahan');

        if (
            empty($provinsi) ||
            empty($kabupaten) ||
            empty($kecamatan) ||
            empty($kelurahan)
        ) {
            return redirect()->to('/skriningdbd')
                ->with('error', 'Data wilayah wajib diisi');
        }

        // ======================
        // SIMPAN WILAYAH
        // ======================

        $modelWilayah = new WilayahSkriningDbdModel();

        $modelWilayah->save([
            'provinsi' => $provinsi ?? '-',
            'kabupaten' => $kabupaten ?? '-',
            'kecamatan' => $kecamatan ?? '-',
            'kelurahan' => $kelurahan ?? '-',
            'rt' => 0,
            'rw' => 0,
            'alamat_lengkap' =>
                $kelurahan . ', ' .
                $kecamatan . ', ' .
                $kabupaten
        ]);

        $id_wilayah = $modelWilayah->insertID();

        // ======================
        // SIMPAN PASIEN
        // ======================

        $modelPasien = new PasienSkriningdbdModel();

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
        // AMBIL JAWABAN
        // ======================

        $p1  = (int)$this->request->getPost('p1');
        $p2  = (int)$this->request->getPost('p2');
        $p3  = (int)$this->request->getPost('p3');
        $p4  = (int)$this->request->getPost('p4');
        $p5  = (int)$this->request->getPost('p5');
        $p6  = (int)$this->request->getPost('p6');
        $p7  = (int)$this->request->getPost('p7');
        $p8  = (int)$this->request->getPost('p8');
        $p9  = (int)$this->request->getPost('p9');
        $p10 = (int)$this->request->getPost('p10');
        $p11 = (int)$this->request->getPost('p11');
        $p12 = (int)$this->request->getPost('p12');
        $p13 = (int)$this->request->getPost('p13');

        // pertanyaan negatif dibalik
        $p14 = (int)$this->request->getPost('p14');
        $p15 = (int)$this->request->getPost('p15');

        // ======================
        // HITUNG TOTAL
        // ======================

        $totalBaik =
            $p1 + $p2 + $p3 + $p4 + $p5 +
            $p6 + $p7 + $p8 + $p9 + $p10 +
            $p11 + $p12 + $p13 + $p14 + $p15;

        // ======================
        // DECISION TREE C4.5
        // ======================

        if ($totalBaik <= 4) {

            $hasil = "Kategori Lingkungan Buruk";

        } else {

            if ($p3 == 0) {

                if ($p6 == 0) {

                    if ($p8 == 0) {

                        if ($p4 == 0) {

                            if ($p15 == 0) {

                                if ($p12 == 0) {

                                    $hasil = "Kategori Lingkungan Buruk";

                                } else {

                                    if ($p13 == 0) {

                                        $hasil = "Kategori Lingkungan Buruk";

                                    } else {

                                        $hasil = "Kategori Lingkungan Cukup";
                                    }
                                }

                            } else {

                                if ($p1 == 0) {

                                    $hasil = "Kategori Lingkungan Cukup";

                                } else {

                                    $hasil = "Kategori Lingkungan Buruk";
                                }
                            }

                        } else {

                            $hasil = "Kategori Lingkungan Cukup";
                        }

                    } else {

                        $hasil = "Kategori Lingkungan Cukup";
                    }

                } else {

                    $hasil = "Kategori Lingkungan Cukup";
                }

            } else {

                if ($p13 == 0) {

                    if ($p5 == 0) {

                        $hasil = "Kategori Lingkungan Buruk";

                    } else {

                        $hasil = "Kategori Lingkungan Cukup";
                    }

                } else {

                    $hasil = "Kategori Lingkungan Baik";
                }
            }
        }

        // ======================
        // SIMPAN SKRINING
        // ======================

        $modelSkrining = new SkriningdbdModel();

        $modelSkrining->save([
            'id_pasien_skrining' => $id_pasien_skrining,
            'id_penyakit' => 1,
            'tanggal' => date('Y-m-d'),

            'var1' => $p1 ? 'Iya' : 'Tidak',
            'var2' => $p2 ? 'Iya' : 'Tidak',
            'var3' => $p3 ? 'Iya' : 'Tidak',
            'var4' => $p4 ? 'Iya' : 'Tidak',
            'var5' => $p5 ? 'Iya' : 'Tidak',
            'var6' => $p6 ? 'Iya' : 'Tidak',
            'var7' => $p7 ? 'Iya' : 'Tidak',
            'var8' => $p8 ? 'Iya' : 'Tidak',
            'var9' => $p9 ? 'Iya' : 'Tidak',
            'var10' => $p10 ? 'Iya' : 'Tidak',
            'var11' => $p11 ? 'Iya' : 'Tidak',
            'var12' => $p12 ? 'Iya' : 'Tidak',
            'var13' => $p13 ? 'Iya' : 'Tidak',
            'var14' => $p14 ? 'Iya' : 'Tidak',
            'var15' => $p15 ? 'Iya' : 'Tidak',

            'hasil' => $hasil
        ]);

        // ======================
        // KIRIM KE VIEW
        // ======================

        $data = $this->request->getPost();

        $data['provinsi'] = $provinsi;
        $data['kabupaten'] = $kabupaten;
        $data['kecamatan'] = $kecamatan;
        $data['hasil'] = $hasil;

        return view('gol_a/skrining3', $data);
    }
}