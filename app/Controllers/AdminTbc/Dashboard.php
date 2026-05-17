<?php

namespace App\Controllers\AdminTbc;

use Dompdf\Dompdf;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // =========================
    // STEP 1 (FORM DATA DIRI)
    // =========================
    public function step1()
    {
        $db = \Config\Database::connect();
        $data['provinsi'] = $db->table('provinces')
            ->orderBy('prov_name', 'ASC')
            ->get()->getResultArray();

        return view('gol_b/skrining_data', $data);
    }


    // =========================
    // STEP 2 (SIMPAN SESSION)
    // =========================
    public function step2()
    {
        session()->set([

            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'kategori_usia' => $this->request->getPost('kategori_usia'),
            'telepon' => $this->request->getPost('telepon'),

            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kelurahan' => $this->request->getPost('kelurahan'),

            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw')

        ]);

        return view('gol_b/skrining_form');
    }


    // =========================
    // PROSES AKHIR (SIMPAN DB)
    // =========================
    public function proses()
    {
        $db = \Config\Database::connect();

        // ======================
        // AMBIL JAWABAN
        // ======================

        $jawaban = json_decode(
            $this->request->getPost('jawaban'),
            true
        );

        session()->set('jawaban', $jawaban);


        // ======================
        // SIMPAN WILAYAH
        // ======================

        $provinsi  = session()->get('provinsi');
        $kabupaten = session()->get('kabupaten');
        $kecamatan = session()->get('kecamatan');
        $kelurahan = session()->get('kelurahan');
        $rt        = session()->get('rt');
        $rw        = session()->get('rw');

        $alamatLengkap =
            $kelurahan . ', ' .
            $kecamatan . ', ' .
            $kabupaten . ', ' .
            $provinsi .
            ' RT ' . $rt .
            '/RW ' . $rw;

        $dataWilayah = [

            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,

            'rt' => $rt,
            'rw' => $rw,

            'alamat_lengkap' => $alamatLengkap

        ];

        $db->table('wilayah')->insert($dataWilayah);

        $id_wilayah = $db->insertID();


        // ======================
        // SIMPAN PASIEN
        // ======================

        $dataPasien = [

            'nik' => session()->get('nik'),
            'nama_pasien_skrining' => session()->get('nama'),
            'jenis_kelamin' => session()->get('jenis_kelamin'),
            'tanggal_lahir' => session()->get('tanggal_lahir'),
            'usia' => session()->get('kategori_usia'),
            'no_hp' => session()->get('telepon'),

            'created_at' => date('Y-m-d'),

            'id_wilayah' => $id_wilayah

        ];

        $db->table('pasien_skrining')->insert($dataPasien);

        $id_pasien_skrining = $db->insertID();

        session()->set('id_pasien_skrining', $id_pasien_skrining);


        // ======================
        // LOGIC HASIL
        // ======================

        $hasil = "Tidak TB";

        if (
            ($jawaban[0] ?? 0) == 1 &&
            (
                ($jawaban[1] ?? 0) == 1 ||
                ($jawaban[6] ?? 0) == 1 ||
                ($jawaban[12] ?? 0) == 1
            )
        ) {
            $hasil = "TB";
        }


        // ======================
        // SIMPAN SKRINING
        // ======================

        $dataSkrining = [

            'id_pasien_skrining' => $id_pasien_skrining,

            'id_penyakit' => 1,

            'tanggal' => date('Y-m-d'),

            'var1' => ($jawaban[0] ?? 0) ? 'Iya' : 'Tidak',
            'var2' => ($jawaban[1] ?? 0) ? 'Iya' : 'Tidak',
            'var3' => ($jawaban[2] ?? 0) ? 'Iya' : 'Tidak',
            'var4' => ($jawaban[3] ?? 0) ? 'Iya' : 'Tidak',
            'var5' => ($jawaban[4] ?? 0) ? 'Iya' : 'Tidak',
            'var6' => ($jawaban[5] ?? 0) ? 'Iya' : 'Tidak',
            'var7' => ($jawaban[6] ?? 0) ? 'Iya' : 'Tidak',
            'var8' => ($jawaban[7] ?? 0) ? 'Iya' : 'Tidak',
            'var9' => ($jawaban[8] ?? 0) ? 'Iya' : 'Tidak',
            'var10' => ($jawaban[9] ?? 0) ? 'Iya' : 'Tidak',
            'var11' => ($jawaban[10] ?? 0) ? 'Iya' : 'Tidak',
            'var12' => ($jawaban[11] ?? 0) ? 'Iya' : 'Tidak',
            'var13' => ($jawaban[12] ?? 0) ? 'Iya' : 'Tidak',

            'hasil' => $hasil

        ];

        $db->table('skrining')->insert($dataSkrining);


        // ======================
        // SESSION HASIL
        // ======================

        session()->set('hasil', $hasil);

        return redirect()->to('/hasil');
    }


    // =========================
    // GET KODE POS (AJAX)
    // =========================
    public function getKodePos()
    {
        $db = \Config\Database::connect();

        $kel = strtolower($this->request->getGet('kelurahan'));
        $kec = strtolower($this->request->getGet('kecamatan'));
        $kab = strtolower($this->request->getGet('kabupaten'));

        $kab = str_replace(['kabupaten ', 'kota '], '', $kab);

        $builder = $db->table('tbl_kodepos');
        $builder->like('LOWER(kelurahan)', $kel);
        $builder->like('LOWER(kecamatan)', $kec);
        $builder->like('LOWER(kabupaten)', $kab);

        $result = $builder->get()->getRow();

        return $this->response->setJSON([
            'kodepos' => $result->kodepos ?? '-'
        ]);
    }


    // =========================
    // CETAK PDF
    // =========================
    public function cetak(int $id)
    {
        $db = \Config\Database::connect();

        // JOIN 3 tabel sekaligus
        $data['data'] = $db->table('pasien_skrining ps')
            ->select('
            ps.nik,
            ps.nama_pasien_skrining AS nama,
            ps.jenis_kelamin,
            ps.tanggal_lahir,
            ps.usia AS kategori_usia,
            w.provinsi,
            w.kabupaten,
            w.kecamatan,
            w.kelurahan,
            w.rt,
            w.rw,
            s.tanggal AS tanggal_skrining,
            s.var1,  s.var2,  s.var3,  s.var4,  s.var5,
            s.var6,  s.var7,  s.var8,  s.var9,  s.var10,
            s.var11, s.var12, s.var13,
            s.hasil
        ')
            ->join('wilayah w',  'w.id_wilayah = ps.id_wilayah')
            ->join('skrining s', 's.id_pasien_skrining = ps.id_pasien_skrining')
            ->where('ps.id_pasien_skrining', $id)
            ->get()
            ->getRowArray();

        $html = view('gol_b/hasil_pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("hasil_skrining.pdf", ["Attachment" => true]);
    }


    // =========================
    // GET KABUPATEN
    // =========================
    public function getKabupaten(int $provinsi)
    {
        $db = \Config\Database::connect();

        $data = $db->table('wilayah')
            ->select('kabupaten')
            ->where('provinsi', $provinsi)
            ->groupBy('kabupaten')
            ->get()
            ->getResult();

        return $this->response->setJSON($data);
    }


    // =========================
    // GET KECAMATAN
    // =========================
    public function getKecamatan(int $kabupaten)
    {
        $db = \Config\Database::connect();

        $data = $db->table('wilayah')
            ->select('kecamatan')
            ->where('kabupaten', $kabupaten)
            ->groupBy('kecamatan')
            ->get()
            ->getResult();

        return $this->response->setJSON($data);
    }


    // =========================
    // GET KELURAHAN
    // =========================
    public function getKelurahan(int $kecamatan)
    {
        $db = \Config\Database::connect();

        $data = $db->table('wilayah')
            ->select('kelurahan')
            ->where('kecamatan', $kecamatan)
            ->groupBy('kelurahan')
            ->get()
            ->getResult();

        return $this->response->setJSON($data);
    }
}