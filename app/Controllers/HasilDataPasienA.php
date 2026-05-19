<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HasilDataPasienA extends Controller
{
    
    private function getDashboardLayout()
    {
        // Mengambil id_jabatan dari session login petugas
        $id_jabatan = session()->get('id_jabatan');

        // Melakukan mapping layout berdasarkan id_jabatan dari tabel petugas/jabatan
        switch ($id_jabatan) {
            case 1:
                return 'layout/dashboard_layout_kepala';   // id_jabatan 1 -> Admin
            case 2:
                return 'layout/dashboard_layout_kader';   // id_jabatan 2 -> Kader
            case 3:
                return 'layout/dashboard_layout_admin';  // id_jabatan 3 -> Kepala
            default:
                // Fallback jika id_jabatan berupa superadmin (4) atau belum login
                return 'layout/dashboard_layout_admin'; 
        }
    }

// ================= HALAMAN DASHBOARD UTAMA =================
    public function hasil_data()
    {
        $layout_dinamis = $this->getDashboardLayout();
        $pasien = session()->get('pasien') ?? [];
        return view('gol_a/hasil_data_pasien/hasil_data_a', [
            'layout'   => $layout_dinamis, 
            'menu'     => 'hasil',
            'judul'   => 'Hasil Data Pasien',
            'penyakit' => 'dbd',
            'data'     => $pasien
        ]);
    }

    // ================= FETCH DATA REALTIME BY TAHUN (AJAX) =================
    public function get_data_pasien_by_tahun()
    {
        $tahun = $this->request->getGet('tahun');
        $id_penyakit_session = session()->get('id_penyakit') ?? 1; 

        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');

        $builder->select("
            MONTH(p.tgl_kunjungan) as bulan_angka,
            w.kelurahan,
            SUM(CASE WHEN p.umur BETWEEN 0 AND 6 THEN 1 ELSE 0 END) as bayi_anak_prasekolah,
            SUM(CASE WHEN p.umur > 6 AND p.umur <= 18 THEN 1 ELSE 0 END) as sekolah_dan_remaja,
            SUM(CASE WHEN p.umur > 18 AND p.umur <= 59 THEN 1 ELSE 0 END) as dewasa,
            SUM(CASE WHEN p.umur >= 60 THEN 1 ELSE 0 END) as lansia,
            SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,
            SUM(CASE WHEN p.status_akhir = 'Meninggal' THEN 1 ELSE 0 END) as jumlah_kematian,
            COUNT(*) as jumlah
        ");

        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
        $builder->where('p.id_penyakit', $id_penyakit_session); 

        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');
        $builder->orderBy('bulan_angka', 'ASC');

        $data = $builder->get()->getResultArray();

        $bulanMap = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach ($data as &$d) {
            $d['bulan'] = $bulanMap[$d['bulan_angka']] ?? '-';
        }

        return $this->response->setJSON($data);
    }
    
    // ================= LIST FILTER TAHUN UNTUK EXPORT =================
    public function get_tahun_list()
    {
        $id_penyakit_session = session()->get('id_penyakit') ?? 1;
        $db = \Config\Database::connect();

        $data = $db->table('pasien')
            ->select('YEAR(tgl_kunjungan) as tahun')
            ->where('id_penyakit', $id_penyakit_session)
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }

    // ================= ENGINE LAPORAN EXPORT (EXCEL / PDF) =================
    public function export_hasil_data_pasien()
    {
        $layout_dinamis = $this->getDashboardLayout();

        $type = $this->request->getGet('type');
        $mode = $this->request->getGet('mode');
        $tahun = $this->request->getGet('tahun');
        $waktu = $this->request->getGet('waktu');
        $kelurahan = $this->request->getGet('kelurahan');

        $id_penyakit_session = session()->get('id_penyakit') ?? 1;

        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');
        $builder->select('
            p.nik, p.nama_pasien, p.tgl_kunjungan, p.ctt_klinis, p.jenis_kelamin,
            p.umur, p.status_akhir, p.tindak_lanjut, w.kelurahan, w.kecamatan,
            w.kabupaten, w.provinsi, w.rt, w.rw, w.alamat_lengkap
        ');
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
        $builder->where('p.id_penyakit', $id_penyakit_session); 

        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        if (!empty($waktu)) {
            if ($mode == 'bulanan') {
                $builder->where('MONTH(p.tgl_kunjungan)', $waktu);
            } elseif ($mode == 'triwulan') {
                $start = ($waktu - 1) * 3 + 1;
                $end   = $start + 2;
                $builder->where('MONTH(p.tgl_kunjungan) >=', $start)->where('MONTH(p.tgl_kunjungan) <=', $end);
            } elseif ($mode == 'semester') {
                if ($waktu == 1) {
                    $builder->where('MONTH(p.tgl_kunjungan) <=', 6);
                } else {
                    $builder->where('MONTH(p.tgl_kunjungan) >=', 7);
                }
            }
        }

        if (!empty($kelurahan) && strtolower(trim($kelurahan)) != 'semua') {
            $builder->where('LOWER(w.kelurahan)', strtolower(trim($kelurahan)));
        }

        $data = $builder->get()->getResultArray();

        if (!$type) {
            return view('gol_a/hasil_data_pasien/export_hasil_data_pasien', [
                'layout'      => $layout_dinamis, // Mengirimkan layout ke view
                'menu' => 'hasil',
                'penyakit' => 'dbd',
                'judul' => 'Eksport Data Pasien',
                'data' => $data 
            ]);
        }

        if ($type == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=data_pasien_dbd.xls");
            echo "<html><head><meta charset='UTF-8'><style>body{ font-family: Arial; font-size:12px; } table{ border-collapse:collapse; width:100%; } th{ background:#2c3e50; color:white; padding:8px; border:1px solid #000; } td{ border:1px solid #999; padding:6px; }</style></head><body><h2>DATA PASIEN DBD</h2><table><tr><th>No</th><th>NIK</th><th>Nama Pasien</th><th>Tgl Kunjungan</th><th>JK</th><th>Usia</th><th>Catatan Klinis</th><th>Alamat</th><th>Status Akhir</th></tr>";
            $no = 1;
            foreach ($data as $d) {
                $alamat = $d['alamat_lengkap'] . ", RT " . $d['rt'] . "/RW " . $d['rw'];
                echo "<tr><td>{$no}</td><td>'{$d['nik']}</td><td>{$d['nama_pasien']}</td><td>{$d['tgl_kunjungan']}</td><td>{$d['jenis_kelamin']}</td><td>{$d['umur']} Thn</td><td>{$d['ctt_klinis']}</td><td>{$alamat}</td><td>{$d['status_akhir']}</td></tr>";
                $no++;
            }
            echo "</table></body></html>";
            exit;
        }

        if ($type == 'pdf') {
            $html = view('gol_a/hasil_data_pasien/export_pdf_pasien', ['data' => $data]);
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("data_pasien_dbd.pdf", ["Attachment" => true]);
            exit;
        }
    }

    // ================= 1. HALAMAN RINCIAN DETAIL DRILL-DOWN =================
    public function detail_pasien()
    {
        // Baris 171 Anda yang memanggil fungsi penentu layout dinamis
        $layout_dinamis = $this->getDashboardLayout();

        $bulan_angka = $this->request->getGet('bulan');
        $kelurahan = $this->request->getGet('kelurahan');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $id_penyakit_session = session()->get('id_penyakit') ?? 1;

        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');
        $builder->select('p.*, w.*');
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
        $builder->where('p.id_penyakit', $id_penyakit_session);
        $builder->where('MONTH(p.tgl_kunjungan)', $bulan_angka);
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        $builder->where('w.kelurahan', $kelurahan);
        
        $data_pasien = $builder->get()->getResultArray();

        $bulanMap = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('gol_a/hasil_data_pasien/detail_pasien_kelurahan', [
            'layout'      => $layout_dinamis, // Mengirimkan layout ke view
            'menu'        => 'hasil',
            'penyakit'    => 'dbd',
            'judul'       => 'Detail Pasien Kelurahan ' . $kelurahan,
            'data_pasien' => $data_pasien,
            'nama_bulan'  => $bulanMap[$bulan_angka] ?? '-',
            'bulan_angka' => $bulan_angka,
            'kelurahan'   => $kelurahan,
            'tahun'       => $tahun
        ]);
    }

    // ==========================================
    // PROSES UPDATE DATA PASIEN & WILAYAH BERANTAI
    // ==========================================
    public function update_pasien(int $id_pasien)
    {
        $db = \Config\Database::connect();
        
        // Mengambil data pasien lama untuk mengetahui id_wilayah terkait
        $pasienLama = $db->table('pasien')->where('id_pasien', $id_pasien)->get()->getRowArray();
        
        if (!$pasienLama) {
            return redirect()->back()->with('error', 'Data pasien tidak ditemukan.');
        }

        // 1. Ambil data input penanggalan untuk kalkulasi redirect URL setelah save
        $tgl_kunjungan_baru = $this->request->getPost('tgl_kunjungan');
        $bulan_angka = date('n', strtotime($tgl_kunjungan_baru));
        $tahun_angka = date('Y', strtotime($tgl_kunjungan_baru));
        $kelurahan_baru = $this->request->getPost('kelurahan');

        // 2. UPDATE TABEL PASIEN
        // Menyimpan NIK 16 digit, Tanggal Lahir, Tanggal Kunjungan, dan Umur hasil hitungan JavaScript
        $dataPasienUpdate = [
            'nik'           => $this->request->getPost('nik'),
            'nama_pasien'   => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tgl_lahir'     => $this->request->getPost('tgl_lahir'),
            'tgl_kunjungan' => $tgl_kunjungan_baru,
            'umur'          => (int)$this->request->getPost('umur'), // Menyimpan angka tahun (0 jika di bawah 1 tahun)
            'ctt_klinis'    => $this->request->getPost('ctt_klinis'),
            'status_akhir'  => $this->request->getPost('status_akhir'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
        ];
        
        $db->table('pasien')->where('id_pasien', $id_pasien)->update($dataPasienUpdate);

        // 3. UPDATE TABEL WILAYAH (Berdasarkan id_wilayah milik pasien)
        // Menyimpan data Provinsi, Kabupaten, Kecamatan, Kelurahan dari API dan Auto-koordinat Desa
        $dataWilayahUpdate = [
            'provinsi'       => $this->request->getPost('provinsi'),
            'kabupaten'      => $this->request->getPost('kabupaten'),
            'kecamatan'      => $this->request->getPost('kecamatan'),
            'kelurahan'      => $kelurahan_baru,
            'latitude'       => $this->request->getPost('latitude'),
            'longitude'      => $this->request->getPost('longitude'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'rt'             => $this->request->getPost('rt'),
            'rw'             => $this->request->getPost('rw'),
        ];

        $db->table('wilayah')->where('id_wilayah', $pasienLama['id_wilayah'])->update($dataWilayahUpdate);

        // Redirect kembali ke halaman detail kelompok kelurahan & bulan yang sesuai agar data langsung ter-refresh
        return redirect()->to(base_url("dbd/detail-pasien?bulan={$bulan_angka}&kelurahan={$kelurahan_baru}&tahun={$tahun_angka}"))
                        ->with('success', 'Data rekam medis dan wilayah administratif pasien berhasil diperbarui.');
    }

    // ================= 3. PROSES DELETE DATA PASIEN =================
    public function delete_pasien(int $id_pasien)
    {
        $db = \Config\Database::connect();
        
        $pasien = $db->table('pasien')->where('id_pasien', $id_pasien)->get()->getRowArray();
        $wilayah = $db->table('wilayah')->where('id_wilayah', $pasien['id_wilayah'])->get()->getRowArray();
        
        $bulan_angka = date('n', strtotime($pasien['tgl_kunjungan']));
        $tahun_angka = date('Y', strtotime($pasien['tgl_kunjungan']));

        $db->table('pasien')->where('id_pasien', $id_pasien)->delete();
        $db->table('wilayah')->where('id_wilayah', $pasien['id_wilayah'])->delete();

        return redirect()->to(base_url("dbd/detail-pasien?bulan={$bulan_angka}&kelurahan={$wilayah['kelurahan']}&tahun={$tahun_angka}"))
                         ->with('success', 'Data pasien berhasil dihapus.');
    }
}