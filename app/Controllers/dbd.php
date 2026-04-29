<?php

namespace App\Controllers;
use App\Models\InputDataPasienModel;
class Dbd extends BaseController
{
    public function inputData()
    {
        return view('gol_a/input_data', [
            'menu' => 'inputdata',
            'penyakit' => 'dbd'
        ]);
    }

    public function hasil_data()
    {
        $pasien = session()->get('pasien') ?? [];

        return view('gol_a/hasil_data_a', [
            'menu' => 'hasil',
            'penyakit' => 'dbd',
            'pasien' => $pasien
        ]);
    }

   public function simpandatapasien()
    {
        $model = new InputDataPasienModel();

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

   //FORM KADER PSN

    public function formulirpsn()
    {
        return view('gol_a/formkader/formulir');
    }

    public function simpanpsn()
    {
        $session = session();
        $data = $this->request->getPost();

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
            $data['foto'] = $namaFile;
        }

        $laporanpsn = $session->get('laporanpsn') ?? [];

        $laporanpsn[$data['posyandu']] = [
            'kelurahan'    => $data['kelurahan'],
            'tanggalinput' => date('Y-m-d'),
            'diperiksa'    => $data['diperiksa'],
            'positif'      => $data['positif'],
            'bagian'       => $data['bagian'],
            'foto'         => $data['foto'] ?? null
        ];

        $session->set('laporanpsn', $laporanpsn);

        return redirect()->to('formkader/formulir');
    }


    // ================= REKAP + FILTER =================
    public function rekappsn()
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        $posyandu = [];
        for ($i = 1; $i <= 95; $i++) {

        // Tambahkan nomor utama
        $posyandu[] = "CATLEYA $i";

        // Sisipkan bayangan setelah nomor tertentu
        if ($i == 36) {
            $posyandu[] = "CATLEYA 36A (BAYANGAN)";
        }

        if ($i == 58) {
            $posyandu[] = "CATLEYA 58A (BAYANGAN)";
        }

        if ($i == 65) {
            $posyandu[] = "CATLEYA 65A (BAYANGAN)";
        }

        if ($i == 78) {
            $posyandu[] = "CATLEYA 78A (BAYANGAN)";
        }

        if ($i == 88) {
            $posyandu[] = "CATLEYA 88A (BAYANGAN)";
        }

        if ($i == 92) {
            $posyandu[] = "CATLEYA 92A (BAYANGAN)";
        }

        if ($i == 95) {
            $posyandu[] = "CATLEYA 95B (BAYANGAN)";
        }
        }

        // FILTER
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');
        $statusFilter = $this->request->getGet('status');
        $kelFilter = strtolower($this->request->getGet('kelurahan'));
        $posFilter = strtolower($this->request->getGet('posyandu'));

        $filtered = [];
        $totalPositif = 0;
        $totalDiperiksa = 0;

        foreach ($posyandu as $pos) {

            $data = $laporanpsn[$pos] ?? null;
            $status = $data ? 'sudah' : 'belum';

            // filter posyandu
            if ($posFilter && strpos(strtolower($pos), $posFilter) === false) continue;

            // filter status
            if ($statusFilter && $status != $statusFilter) continue;

            // filter kelurahan
            if ($kelFilter && strpos(strtolower($data['kelurahan'] ?? ''), $kelFilter) === false) continue;

            // filter tanggal (AMAN)
            $tanggal = $data['tanggalinput'] ?? null;
            $t = $tanggal ? strtotime($tanggal) : null;
            $s = $start ? strtotime($start) : null;
            $e = $end ? strtotime($end) : null;

            if (($s || $e) && !$t) continue;
            if ($s && $t < $s) continue;
            if ($e && $t > $e) continue;

            $filtered[$pos] = $data;

            $totalPositif += (int)($data['positif'] ?? 0);
            $totalDiperiksa += (int)($data['diperiksa'] ?? 0);
        }

        return view('gol_a/formkader/rekap', [
            'laporanpsn' => $filtered,
            'totalPositif' => $totalPositif,
            'totalDiperiksa' => $totalDiperiksa
        ]);
    }

    // ================= DETAIL =================
    public function detailpsn(int$pos)
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        return view('gol_a/formkader/detail', [
            'pos' => $pos,
            'data' => $laporanpsn[$pos] ?? null
        ]);
    }


    public function exportrekappsn()
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=rekap_posyandu.xls");

        echo "<table border='1'>";
        echo "<tr style='background:#D9EAD3; font-weight:bold;'>
                <th>Posyandu</th>
                <th>Kelurahan</th>
                <th>Tanggal</th>
                <th>Diperiksa</th>
                <th>Positif</th>
                <th style='width:200px;'>Foto</th>
            </tr>";

        // daftar posyandu (biar urut)
        $posyandu = [];

        for ($i = 1; $i <= 95; $i++) {

            $posyandu[] = "CATLEYA $i";

            if ($i == 36) $posyandu[] = "CATLEYA 36A (BAYANGAN)";
            if ($i == 58) $posyandu[] = "CATLEYA 58A (BAYANGAN)";
            if ($i == 65) $posyandu[] = "CATLEYA 65A (BAYANGAN)";
            if ($i == 78) $posyandu[] = "CATLEYA 78A (BAYANGAN)";
            if ($i == 88) $posyandu[] = "CATLEYA 88A (BAYANGAN)";
            if ($i == 92) $posyandu[] = "CATLEYA 92A (BAYANGAN)";
            if ($i == 95) $posyandu[] = "CATLEYA 95B (BAYANGAN)";
        }

        foreach ($posyandu as $pos) {

            $data = $laporanpsn[$pos] ?? null;

            // cek foto
            $foto = '-';
            if (!empty($data['foto'])) {
                $url = base_url('uploads/' . $data['foto']);
                $foto = "<img src='$url' width='80'>";
            }

            // warna merah kalau belum diisi
            $bg = !$data ? "style='background-color:#f4cccc'" : "";

            echo "<tr $bg>
                    <td>{$pos}</td>
                    <td>".($data['kelurahan'] ?? '-')."</td>
                    <td>".($data['tanggalinput'] ?? '-')."</td>
                    <td>".($data['diperiksa'] ?? '0')."</td>
                    <td>".($data['positif'] ?? '0')."</td>
                    <td>{$foto}</td>
                </tr>";
        }

        echo "</table>";
    }

    public function dashboard()
    {
        return view('gol_a/dashboard_kader', [
            'menu' => 'dashboard',
            'penyakit' => 'dbd'
        ]);
    }

    public function peta()
    {
        // ... (Logika untuk mengambil data $dbd Anda jika ada) ...
        
        $data = [
            'title' => 'Peta Sebaran DBD',
            'menu'  => 'peta_sebaran', // <--- Harus sama dengan yang ada di pengecekan if ($menu == '...')
            'dbd'   => [] // Isi array data dbd Anda di sini
        ];

        // Ganti 'peta_view' dengan nama file view peta Anda (misalnya 'kader/peta_view')
        return view('gol_a/peta_sebaran_kader', $data); 
    }
}
