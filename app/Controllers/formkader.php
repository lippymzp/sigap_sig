<?php

namespace App\Controllers;

use CodeIgniter\Controller;

// ================= PHP SPREADSHEET =================
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class formkader extends Controller
{
    // ================= FORM =================
    public function formulir()
    {
        return view('formkader/formulir');
    }

    // ================= SIMPAN =================
    public function simpan()
    {
        $session = session();
        $data = $this->request->getPost();

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
            $data['foto'] = $namaFile;
        }

        $laporan = $session->get('laporan') ?? [];

        $laporan[$data['posyandu']] = [
            'kelurahan'    => $data['kelurahan'],
            'tanggalinput' => date('Y-m-d'),
            'diperiksa'    => $data['diperiksa'],
            'positif'      => $data['positif'],
            'bagian'       => $data['bagian'],
            'foto'         => $data['foto'] ?? null
        ];

        $session->set('laporan', $laporan);

        return redirect()->to('/formkader/rekap');
    }

    // ================= REKAP + FILTER =================
    public function rekap()
    {
        $session = session();
        $laporan = $session->get('laporan') ?? [];

        $posyandu = [];
        for ($i = 1; $i <= 95; $i++) {
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

            $data = $laporan[$pos] ?? null;
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

        return view('formkader/rekap', [
            'laporan' => $filtered,
            'totalPositif' => $totalPositif,
            'totalDiperiksa' => $totalDiperiksa
        ]);
    }

    // ================= DETAIL =================
    public function detail($pos)
    {
        $session = session();
        $laporan = $session->get('laporan') ?? [];

        return view('formkader/detail', [
            'pos' => $pos,
            'data' => $laporan[$pos] ?? null
        ]);
    }

    // ================= EXPORT EXCEL (FIX TOTAL + GAMBAR) =================
    public function exportExcel()
{
    $session = session();
    $laporan = $session->get('laporan') ?? [];

    if (ob_get_length()) ob_end_clean();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // ================= HEADER =================
    $sheet->setCellValue('A1', 'Posyandu');
    $sheet->setCellValue('B1', 'Kelurahan');
    $sheet->setCellValue('C1', 'Tanggal');
    $sheet->setCellValue('D1', 'Diperiksa');
    $sheet->setCellValue('E1', 'Positif');
    $sheet->setCellValue('F1', 'Foto');

    // HEADER STYLE
    $sheet->getStyle('A1:F1')->applyFromArray([
        'font'=>[
            'bold'=>true
        ],
        'alignment'=>[
            'horizontal'=>'center',
            'vertical'=>'center'
        ],
        'fill'=>[
            'fillType'=>'solid',
            'startColor'=>['rgb'=>'D9EAD3']
        ]
    ]);

    // Lebar kolom
    $sheet->getColumnDimension('A')->setWidth(20);
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(18);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(18);

    $row = 2;
    $posyandu = [];

    for ($i = 1; $i <= 95; $i++) {

        $posyandu[] = "CATLEYA $i";

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

foreach ($posyandu as $pos) {

    $data = $laporan[$pos] ?? null;
        $data = $laporan[$pos] ?? null;

        $sheet->setCellValue("A$row",$pos);
        $sheet->setCellValue("B$row",$data['kelurahan'] ?? '-');
        $sheet->setCellValue("C$row",$data['tanggalinput'] ?? '-');
        $sheet->setCellValue("D$row",$data['diperiksa'] ?? '-');
        $sheet->setCellValue("E$row",$data['positif'] ?? '-');

        // Tinggi baris biar gambar masuk rapi
        $sheet->getRowDimension($row)->setRowHeight(50);

        // Semua isi rata tengah
        $sheet->getStyle("A$row:F$row")->getAlignment()
              ->setHorizontal('center')
              ->setVertical('center');

        // ================= BARIS MERAH JIKA BELUM DIISI =================
        if (!$data) {

            $sheet->getStyle("A$row:F$row")->applyFromArray([
                'fill'=>[
                    'fillType'=>'solid',
                    'startColor'=>[
                        'rgb'=>'F4CCCC'
                    ]
                ]
            ]);
        }

        // ================= GAMBAR =================
        if (!empty($data['foto'])) {

            $path = FCPATH.'uploads/'.$data['foto'];

            if (file_exists($path)) {

                $img = new Drawing();
                $img->setPath($path);

                $img->setCoordinates("F$row");

                // ukuran gambar
                $img->setHeight(45);

                // anchor biar nempel di sel
                $img->setOffsetX(10);
                $img->setOffsetY(5);

                $img->setWorksheet($sheet);
            }
        }

        $row++;
    }

    // Border semua tabel
    $sheet->getStyle("A1:F".($row-1))
          ->getBorders()
          ->getAllBorders()
          ->setBorderStyle(
             \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
          );

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="rekap-psn.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

}