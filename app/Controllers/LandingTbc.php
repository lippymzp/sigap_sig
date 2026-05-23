<?php

namespace App\Controllers;

use App\Models\FunfactTbcModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class LandingTbc extends BaseController
{
    public function index()
    {
        helper(['url', 'text']);

        $funfactModel = new FunfactTbcModel();
        $db = \Config\Database::connect();

        // =========================
        // AMBIL TAHUN TERSEDIA
        // =========================
        $tahunRows = $db->query("
            SELECT DISTINCT YEAR(tgl_kunjungan) AS tahun
            FROM pasien
            WHERE id_penyakit = 2
              AND tgl_kunjungan IS NOT NULL
            ORDER BY tahun DESC
        ")->getResultArray();

        $tahunTersedia = array_column($tahunRows, 'tahun');
        $tahunRequest = $this->request->getGet('tahun');

        if (!empty($tahunRequest) && in_array((int) $tahunRequest, array_map('intval', $tahunTersedia))) {
            $tahunAktif = (int) $tahunRequest;
        } else {
            $tahunAktif = (int) ($tahunTersedia[0] ?? date('Y'));
        }

        // =========================
        // DATA GRAFIK TBC
        // =========================
        $bulanIndo = [
            1  => 'Jan',
            2  => 'Feb',
            3  => 'Mar',
            4  => 'Apr',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $labels = array_values($bulanIndo);
        $kasus = array_fill(0, 12, 0);

        $grafikRows = $db->query("
            SELECT 
                MONTH(tgl_kunjungan) AS bulan,
                COUNT(id_pasien) AS total
            FROM pasien
            WHERE id_penyakit = 2
              AND tgl_kunjungan IS NOT NULL
              AND YEAR(tgl_kunjungan) = ?
            GROUP BY MONTH(tgl_kunjungan)
            ORDER BY MONTH(tgl_kunjungan) ASC
        ", [$tahunAktif])->getResultArray();

        foreach ($grafikRows as $row) {
            $bulan = (int) $row['bulan'];
            $total = (int) $row['total'];

            if ($bulan >= 1 && $bulan <= 12) {
                $kasus[$bulan - 1] = $total;
            }
        }

        $totalKasusTbc = array_sum($kasus);

        // =========================
        // DATA PETA + RINGKASAN TBC - KALIWATES
        // =========================

        // Ambil wilayah Kaliwates dari tabel wilayah
        $wilayahKaliwates = $db->query("
            SELECT 
                id_wilayah,
                kecamatan,
                kelurahan
            FROM wilayah
            WHERE id_wilayah IN (2001, 2002, 2003, 2004, 2005, 2006, 2007)
            ORDER BY id_wilayah ASC
        ")->getResultArray();

        // Hitung kasus TBC dari tabel pasien berdasarkan id_wilayah
        $kasusWilayahRows = $db->query("
            SELECT 
                id_wilayah,
                COUNT(id_pasien) AS kasus
            FROM pasien
            WHERE id_penyakit = 2
              AND tgl_kunjungan IS NOT NULL
              AND YEAR(tgl_kunjungan) = ?
              AND id_wilayah IN (2001, 2002, 2003, 2004, 2005, 2006, 2007)
            GROUP BY id_wilayah
        ", [$tahunAktif])->getResultArray();

        // Ubah hasil query menjadi map: id_wilayah => jumlah kasus
        $kasusMap = [];

        foreach ($kasusWilayahRows as $row) {
            $kasusMap[(int) $row['id_wilayah']] = (int) $row['kasus'];
        }

        // Gabungkan data wilayah + jumlah kasus
        $petaRows = [];

        foreach ($wilayahKaliwates as $wilayah) {
            $idWilayah = (int) $wilayah['id_wilayah'];

            $petaRows[] = [
                'id_wilayah' => $idWilayah,
                'kecamatan'  => $wilayah['kecamatan'],
                'kelurahan'  => $wilayah['kelurahan'],
                'kasus'      => $kasusMap[$idWilayah] ?? 0,
            ];
        }

        // Hitung wilayah terdampak
        $totalWilayahTerdampak = 0;

        foreach ($petaRows as $row) {
            if ((int) $row['kasus'] > 0) {
                $totalWilayahTerdampak++;
            }
        }

        // Urutkan wilayah dari kasus tertinggi
        usort($petaRows, function ($a, $b) {
            return $b['kasus'] <=> $a['kasus'];
        });

        $wilayahTertinggi = $petaRows[0] ?? null;

        // Hitung total kasus ringkasan
        $totalKasusRingkasan = 0;

        foreach ($petaRows as $row) {
            $totalKasusRingkasan += (int) $row['kasus'];
        }

        // Rata-rata kasus per wilayah terdampak
        $rataRataPerWilayah = $totalWilayahTerdampak > 0
            ? round($totalKasusRingkasan / $totalWilayahTerdampak, 1)
            : 0;

        // Hitung data kecamatan
        $kecamatanData = [];

        foreach ($petaRows as $row) {
            $kecamatan = $row['kecamatan'];

            if (!isset($kecamatanData[$kecamatan])) {
                $kecamatanData[$kecamatan] = [
                    'kecamatan'      => $kecamatan,
                    'total_kasus'    => 0,
                    'jumlah_wilayah' => 0,
                ];
            }

            $kecamatanData[$kecamatan]['total_kasus'] += (int) $row['kasus'];

            if ((int) $row['kasus'] > 0) {
                $kecamatanData[$kecamatan]['jumlah_wilayah']++;
            }
        }

        $kecamatanRows = array_values($kecamatanData);

        usort($kecamatanRows, function ($a, $b) {
            return $b['total_kasus'] <=> $a['total_kasus'];
        });

        $kecamatanTertinggi = $kecamatanRows[0] ?? null;

        $rataRataKecamatanTertinggi = 0;

        if (!empty($kecamatanTertinggi) && (int) $kecamatanTertinggi['jumlah_wilayah'] > 0) {
            $rataRataKecamatanTertinggi = round(
                (int) $kecamatanTertinggi['total_kasus'] / (int) $kecamatanTertinggi['jumlah_wilayah'],
                1
            );
        }

        $ringkasanTbc = [
            'wilayah_tertinggi'              => $wilayahTertinggi,
            'kecamatan_tertinggi'            => $kecamatanTertinggi,
            'rata_rata_per_wilayah'          => $rataRataPerWilayah,
            'rata_rata_kecamatan_tertinggi'  => $rataRataKecamatanTertinggi,
            'jumlah_wilayah_terdampak'       => $totalWilayahTerdampak,
            'total_kasus_ringkasan'          => $totalKasusRingkasan,
        ];

        // =========================
        // DATA BERITA TBC
        // =========================
        $beritaTbc = $db->query("
            SELECT 
                id_berita,
                id_penyakit,
                judul_berita,
                deskripsi_berita,
                isi_berita,
                gambar_berita,
                tanggal_berita,
                url_berita,
                status_berita,
                penulis
            FROM berita
            WHERE id_penyakit = 2
            ORDER BY tanggal_berita DESC
            LIMIT 3
        ")->getResultArray();

        // =========================
        // KIRIM DATA KE VIEW
        // =========================
        $data = [
            'slider_images' => [
                base_url('img/banner1.png'),
                base_url('img/banner2.png'),
                base_url('img/banner3.png'),
            ],

            'funfact' => $funfactModel->getFunfactTbc(9),

            'tahunTersedia' => $tahunTersedia,
            'tahunAktif'    => $tahunAktif,

            'grafikTbc' => [
                'labels' => $labels,
                'kasus'  => $kasus,
            ],

            'totalKasusTbc' => $totalKasusTbc,

            'petaTbc'                 => $petaRows,
            'totalWilayahTerdampak'   => $totalWilayahTerdampak,
            'ringkasanTbc'            => $ringkasanTbc,
            'beritaTbc'               => $beritaTbc,
        ];

        return view('gol_b/tbc', $data);
    }

    public function detail_funfact($id)
    {
        helper(['url', 'text']);

        $funfactModel = new FunfactTbcModel();
        $item = $funfactModel->getDetailFunfactTbc($id);

        if (!$item) {
            throw PageNotFoundException::forPageNotFound('Funfact TBC tidak ditemukan');
        }

        return view('gol_b/detail_funfact', [
            'item' => $item,
        ]);
    }
}