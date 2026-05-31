<?php

namespace App\Controllers;

use App\Models\InputDataPasienModel;
use App\Models\wilayahskriningpneumonia;
use App\Models\PasienPneumoniaModel;
use App\Models\SkriningPneumoniaModel;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use DateTime;

class Pneumonia extends BaseController
{
    private function getNotif()
{
    $db = \Config\Database::connect();

    return $db->table('skrining s')

        ->select('
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            s.tanggal,
            s.hasil
        ')

        ->join(
            'pasien_skrining p',
            'p.id_pasien_skrining = s.id_pasien_skrining'
        )

        ->where('s.id_penyakit', 3)

        ->where('s.hasil', 'Berisiko')

        ->orderBy('s.id_skrining', 'DESC')

        ->get()

        ->getResultArray();
}

private function getNotifModal()
{
    $db = \Config\Database::connect();

    return $db->table('skrining s')
        ->select('
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            s.tanggal,
            s.hasil
        ')
        ->join(
            'pasien_skrining p',
            'p.id_pasien_skrining = s.id_pasien_skrining'
        )
        ->where('s.id_penyakit', 3)
        ->where('s.hasil', 'Berisiko')
        ->orderBy('s.id_skrining', 'DESC')
        ->limit(3)
        ->get()
        ->getResultArray();
}

    public function inputData()
    {
        return view('gol_c/input_data', [
            'menu' => 'inputdata',
            'penyakit' => 'pneumonia',
            'judul' => 'Input Data Pasien',
            'notif' => $this->getNotif(), 
            'notifModal' => $this->getNotifModal()
        ]);
        
    }
    public function editData($id)
{
    $db = \Config\Database::connect();

    $builder = $db->table('pasien p');

    $builder->select("
        p.*,

        w.provinsi,
        w.kabupaten,
        w.kecamatan,
        w.kelurahan,
        w.rt,
        w.rw,
        w.alamat_lengkap,
        w.latitude,
        w.longitude
    ");

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    $builder->where('p.id_pasien', $id);

    $pasien = $builder->get()->getRowArray();

    return view('gol_c/input_data', [

        'menu' => 'inputdata',
        'penyakit' => 'pneumonia',
        'judul' => 'Edit Data Pasien',

        'pasien' => $pasien,

        'notif' => $this->getNotif(),
        'notifModal' => $this->getNotifModal()
    ]);
}

public function hasil_data($tahun = null)
{
    $tahun = $tahun ?? date('Y');

    $model = new \App\Models\InputDataPasienModel();

    $db = \Config\Database::connect();

    $builder = $db->table('pasien p');

    $builder->select("
        p.id_pasien,
        p.id_wilayah,
        p.nama_pasien,
        p.jenis_kelamin,
        p.rentang_umur,
        p.ctt_klinis,
        p.antibiotik,
        p.tgl_kunjungan,
        
       w.kelurahan,
w.rt,
w.rw,

        CONCAT(
            w.provinsi, ', ',
            w.kabupaten, ', ',
            w.kecamatan, ', ',
            w.kelurahan
        ) as wilayah
    ");

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    $builder->where('p.id_penyakit', 3);

    $builder->where(
        'YEAR(p.tgl_kunjungan)',
        $tahun
    );

    $builder->orderBy('p.id_pasien', 'DESC');

   // ================= PAGINATION =================

$perPage = 10;

$currentPage = (int) ($this->request->getVar('page_data') ?? 1);

$totalData = $builder->countAllResults(false);

$totalPages = ceil($totalData / $perPage);

$data = $builder
    ->limit($perPage, ($currentPage - 1) * $perPage)
    ->get()
    ->getResultArray();

    return view('gol_c/hasil_data_pasien/hasil_data_c', [

        'menu' => 'hasil',
        'penyakit' => 'pneumonia',
        'judul' => 'Hasil Data Pasien',
        'tahun' => $tahun,
        'data' => $data,
'totalPages'  => $totalPages,
'currentPage' => $currentPage,
        'notif' => $this->getNotif(),
        'notifModal' => $this->getNotifModal()
    ]);
}
    // ==================================
    // HASIL DATA PASIEN EXPOR PDF EXCEL
    // ==================================

    // ================= buat hasil data pasiennn  =================
    public function get_data_pasien_by_tahun()
    {
        $tahun = $this->request->getGet('tahun');

        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');

        // QUERY UTAMA
        $builder->select("
            MONTH(p.tgl_kunjungan) as bulan_angka,
            w.kelurahan,

            SUM(
    CASE
        WHEN p.rentang_umur IN (
            '0-12 Bulan',
            '1-5 Tahun',
            '6-11 Tahun',
            '12-16 Tahun',
            '17-25 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as anak,

SUM(
    CASE
        WHEN p.rentang_umur IN (
            '26-35 Tahun',
            '36-45 Tahun',
            '46-55 Tahun',
            '56-65 Tahun',
            '>65 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as dewasa,

            SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

            COUNT(*) as jumlah
        ");

        // JOIN
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // FILTER TAHUN
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);

        $builder->where('p.id_penyakit', 3); // filter penyakit pneumonia

        // GROUP BY WAJIB (BIAR TIDAK ERROR ONLY_FULL_GROUP_BY)
        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');

        // URUT BULAN
        $builder->orderBy('bulan_angka', 'ASC');

        $hasil = $builder->get()->getResultArray();

        // CONVERT BULAN KE INDONESIA
        $bulanMap = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        foreach ($hasil as &$d) {
            $d['bulan'] = $bulanMap[$d['bulan_angka']] ?? '-';
        }

return $this->response->setJSON($hasil);

        return $this->response->setJSON($data);
    }
    
    // ================= list tahun di export data =================
    public function get_tahun_list()
    {
        $db = \Config\Database::connect();

        $data = $db->table('pasien')
            ->select('YEAR(tgl_kunjungan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }


    // ================= HALAMAN =================
    public function export_hasil_data_pasien()
    {
        $fileType = $this->request->getGet('fileType');

        $kelurahan = $this->request->getGet('kelurahan');

        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');

        $jenisData = $this->request->getGet('jenisData');

        $db = \Config\Database::connect();

        if($jenisData == 'pegawai'){

            $builder = $db->table('petugas');

            $builder->select('
                petugas.NIP as nip,
                petugas.nama_petugas,
                i.nama_instansi,
                petugas.no_telp
            ');

            $builder->join(
                'instansi i',
                'i.id_instansi = petugas.id_instansi',
                'left'
            );

            $builder->where(
                'i.nama_instansi',
                'Puskesmas Ajung'
            );

            $hasil = $builder->get()->getResultArray();

            // PDF
            if($fileType == 'pdf'){

                $html = view(
                    'gol_c/hasil_data_pasien/export_pdf_pegawai',
                    [
                        'data' => $hasil
                    ]
                );

                $options = new \Dompdf\Options();

                $options->set('isRemoteEnabled', true);

                $dompdf = new \Dompdf\Dompdf($options);

                $dompdf->loadHtml($html);

                $dompdf->setPaper('A4', 'portrait');

                $dompdf->render();

                $dompdf->stream(
                    "data_pegawai.pdf",
                    ["Attachment" => true]
                );

                exit;
            }
        }else{

        $builder = $db->table('pasien p');

        $builder->join(
            'wilayah w',
            'w.id_wilayah = p.id_wilayah',
            'left'
        );

        // FILTER KELURAHAN
        if ($kelurahan && $kelurahan != 'all') {

            $builder->where('w.kelurahan', $kelurahan);
        }

        // FILTER TANGGAL
        if ($startDate && $endDate) {

            $builder->where('DATE(p.tgl_kunjungan) >=', $startDate);
            $builder->where('DATE(p.tgl_kunjungan) <=', $endDate);
        }

        $builder->select("
            w.kelurahan,

            SUM(
    CASE
        WHEN p.rentang_umur IN (
            '0-5 Tahun',
            '6-11 Tahun',
            '12-16 Tahun',
            '17-25 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as anak,

SUM(
    CASE
        WHEN p.rentang_umur IN (
            '26-35 Tahun',
            '36-45 Tahun',
            '46-55 Tahun',
            '56-65 Tahun',
            '>65 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as dewasa,
 
            SUM(
                CASE
                    WHEN p.jenis_kelamin = 'Laki-laki'
                    THEN 1
                    ELSE 0
                END
            ) as laki,

            SUM(
                CASE
                    WHEN p.jenis_kelamin = 'Perempuan'
                    THEN 1
                    ELSE 0
                END
            ) as perempuan,

            COUNT(p.id_pasien) as total
        ");

        $builder->groupBy('w.kelurahan');

        $hasil = $builder->get()->getResultArray();
        // kalau belum klik export → tampilkan halaman filter
        if (!$fileType) {
            return view('gol_c/hasil_data_pasien/export_hasil_data_pasien', [
                'menu' => 'export_hasil_data_pasien',
                'penyakit' => 'pneumonia',
                'judul' => 'Eksport Data Pasien',
                'data' => $hasil //
            ]);
        }
        }

    // EXPORT EXCEL
        if($fileType == 'excel'){

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();
            
            // =========================
            // JENIS DATA KASUS
            // =========================
            if($jenisData == 'kasus'){

                $sheet->setCellValue('A1', 'DATA KASUS PNEUMONIA');

                $sheet->fromArray([
                    [
                        'No',
                        'Kelurahan',
                        'Anak-anak',
                        'Dewasa',
                        'Laki-laki',
                        'Perempuan',
                        'Total Kasus'
                    ]
                ], NULL, 'A3');

                // HEADER STYLE
                $sheet->getStyle('A3:G3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'],
                        'size' => 11
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'B07D1A'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                $row = 4;
                $no = 1;

                foreach($hasil as $d){

                    $sheet->setCellValue('A'.$row, $no++);
                    $sheet->setCellValue('B'.$row, $d['kelurahan']);
                    $sheet->setCellValue('C'.$row, $d['anak']);
                    $sheet->setCellValue('D'.$row, $d['dewasa']);
                    $sheet->setCellValue('E'.$row, $d['laki']);
                    $sheet->setCellValue('F'.$row, $d['perempuan']);
                    $sheet->setCellValue('G'.$row, $d['total']);

                    $row++;
                }

                $lastRow = $row - 1;

                $sheet->getStyle('A4:G'.$lastRow)->applyFromArray([

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'C8B37A'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                $sheet->setCellValue('A'.$row, 'Jumlah');

                $sheet->mergeCells('A'.$row.':B'.$row);

                $sheet->setCellValue(
                    'G'.$row,
                    '=SUM(G4:G'.($row-1).')'
                );

                $sheet->getStyle('A'.$row.':G'.$row)->applyFromArray([

                    'font' => [
                        'bold' => true
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'A66F00'
                        ]
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $row += 4;

                $sheet->setCellValue(
                    'F'.$row,
                    'Mengetahui,'
                );

                $row += 2;

                $sheet->setCellValue(
                    'F'.$row,
                    'Kepala Puskesmas Ajung'
                );

                $row += 5;

                $sheet->setCellValue(
                    'F'.$row,
                    ''
                );

                $row++;

                $sheet->setCellValue(
                    'F'.$row,
                    'NIP.'
                );

                foreach(range(3, $row) as $r){
                    $sheet->getRowDimension($r)
                        ->setRowHeight(-1);
                }

            }

            // =========================
            // JENIS DATA PEGAWAI
            // =========================
            else{

                // =========================
                // JUDUL
                // =========================

                $sheet->mergeCells('A1:E1');

                $sheet->setCellValue(
                    'A1',
                    'DATA PEGAWAI PUSKESMAS AJUNG'
                );

                $sheet->getStyle('A1')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 16
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                // =========================
                // HEADER TABEL
                // =========================

                $sheet->fromArray([
                    [
                        'No',
                        'NIP',
                        'Nama Pegawai',
                        'Instansi',
                        'Nomor HP'
                    ]
                ], NULL, 'A3');

                // STYLE HEADER
                $sheet->getStyle('A3:E3')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'B07D1A'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                // =========================
                // ISI DATA
                // =========================

                $row = 4;
                $no = 1;

                foreach($hasil as $d){

                    $sheet->setCellValue(
                        'A'.$row,
                        $no++
                    );

                    $sheet->setCellValue(
                        'B'.$row,
                        $d['nip']
                    );

                    $sheet->setCellValue(
                        'C'.$row,
                        $d['nama_petugas']
                    );

                    $sheet->setCellValue(
                        'D'.$row,
                        $d['nama_instansi']
                    );

                    $sheet->setCellValue(
                        'E'.$row,
                        $d['no_telp']
                    );

                    $row++;
                }

                // =========================
                // STYLE ISI
                // =========================

                $lastRow = $row - 1;

                $sheet->getStyle('A4:E'.$lastRow)->applyFromArray([

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'C8B37A'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                // =========================
                // AUTO SIZE
                // =========================

                foreach(range('A','E') as $col){

                    $sheet->getColumnDimension($col)
                        ->setAutoSize(true);
                }

                // =========================
                // TTD
                // =========================

                $row += 4;

                $sheet->setCellValue(
                    'D'.$row,
                    'Mengetahui,'
                );

                $row += 2;

                $sheet->setCellValue(
                    'D'.$row,
                    'Kepala Puskesmas Ajung'
                );

                $row += 5;

                $sheet->setCellValue(
                    'D'.$row,
                    ''
                );

                $row++;

                $sheet->setCellValue(
                    'D'.$row,
                    'NIP.'
                );

                // =========================
                // AUTO HEIGHT
                // =========================

                foreach(range(3, $row) as $r){

                    $sheet->getRowDimension($r)
                        ->setRowHeight(-1);
                }
            }

            // OUTPUT
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

            header(
                'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            );

            header(
                'Content-Disposition: attachment;filename="export_data.xlsx"'
            );

            header('Cache-Control: max-age=0');

            $writer->save('php://output');

            exit;
        }

        // EXPORT PDF
        if ($fileType == 'pdf') {
            $html = view('gol_c/hasil_data_pasien/export_pdf_berita_acara', ['data' => $hasil]);

            $options = new \Dompdf\Options();

            $options->set('isRemoteEnabled', true);

            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("data_pasien.pdf", ["Attachment" => true]);
            exit;
        }
    }

    public function preview_export()
    {
        $db = \Config\Database::connect();
        $kelurahan = $this->request->getGet('kelurahan');

        $startDate = $this->request->getGet('startDate');

        $endDate = $this->request->getGet('endDate');

        $jenisData = $this->request->getGet('jenisData');

        if($jenisData == 'pegawai'){

            $builder = $db->table('petugas');

            $builder->select('
                petugas.NIP as nip,
                petugas.nama_petugas,
                i.nama_instansi,
                petugas.no_telp
            ');

            $builder->join(
                'instansi i',
                'i.id_instansi = petugas.id_instansi',
                'left'
            );

            $builder->where(
                'i.nama_instansi',
                'Puskesmas Ajung'
            );

            $hasil = $builder->get()->getResultArray();

            return view(
                'gol_c/hasil_data_pasien/export_pdf_pegawai',
                [
                    'data' => $hasil
                ]
            );
        }

        $builder = $db->table('pasien p');

        $builder->join(
            'wilayah w',
            'w.id_wilayah = p.id_wilayah',
            'left'
        );

        $builder->select("
            w.kelurahan,

            SUM(
    CASE
        WHEN p.rentang_umur IN (
            '0-5 Tahun',
            '6-11 Tahun',
            '12-16 Tahun',
            '17-25 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as anak,

SUM(
    CASE
        WHEN p.rentang_umur IN (
            '26-35 Tahun',
            '36-45 Tahun',
            '46-55 Tahun',
            '56-65 Tahun',
            '>65 Tahun'
        )
        THEN 1
        ELSE 0
    END
) as dewasa,
            SUM(
                CASE
                    WHEN p.jenis_kelamin = 'Laki-laki'
                    THEN 1
                    ELSE 0
                END
            ) as laki,

            SUM(
                CASE
                    WHEN p.jenis_kelamin = 'Perempuan'
                    THEN 1
                    ELSE 0
                END
            ) as perempuan,

            COUNT(p.id_pasien) as total
        ");

        $builder->groupBy('w.kelurahan');

        // FILTER KELURAHAN
        if($kelurahan && $kelurahan != 'all'){

            $builder->where(
                'w.kelurahan',
                $kelurahan
            );
        }

        // FILTER TANGGAL
        if($startDate && $endDate){

            $builder->where(
                'DATE(p.tgl_kunjungan) >=',
                $startDate
            );

            $builder->where(
                'DATE(p.tgl_kunjungan) <=',
                $endDate
            );
        }
        
        $hasil = $builder->get()->getResultArray();

        return view(
            'gol_c/hasil_data_pasien/export_pdf_berita_acara',
            [
                'data' => $hasil
            ]
        );
    }

public function updatePasien()
{
    $id = $this->request->getPost('id_pasien');

    $db = \Config\Database::connect();

    $builder = $db->table('pasien');

    $builder->where('id_pasien', $id);

    $builder->update([

    'nama_pasien' => $this->request->getPost('nama_pasien'),    

    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),

        'rentang_umur' => $this->request->getPost('rentang_umur'),

        'ctt_klinis' => $this->request->getPost('ctt_klinis'),

        'antibiotik' => $this->request->getPost('antibiotik'),

        'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan')
    ]);

    // ================= UPDATE WILAYAH =================

$db->table('wilayah')

   ->where(
       'id_wilayah',
       $this->request->getPost('id_wilayah')
   )

   ->update([

        'kelurahan' =>
            $this->request->getPost('kelurahan'),

        'rt' =>
            $this->request->getPost('rt'),

        'rw' =>
            $this->request->getPost('rw'),

        'alamat_lengkap' =>
            $this->request->getPost('alamat')

   ]);

    return redirect()->back();
}

public function hapusPasien($id)
{
    $db = \Config\Database::connect();

    // ======================
    // AMBIL ID WILAYAH
    // ======================

    $pasien = $db->table('pasien')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    if($pasien){

        $idWilayah = $pasien['id_wilayah'];

        // ======================
        // HAPUS PASIEN
        // ======================

        $db->table('pasien')
            ->where('id_pasien', $id)
            ->delete();

        // ======================
        // HAPUS WILAYAH
        // ======================

        $db->table('wilayah')
            ->where('id_wilayah', $idWilayah)
            ->delete();
    }

    return redirect()->back();
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

            'diagnosa' => $this->request->getPost('diagnosa'),
            
            'antibiotik' => $this->request->getPost('antibiotik'),

            'rentang_umur' => $this->request->getPost('rentang_umur'),

            'catatan' => $this->request->getPost('catatan'),

            'id_penyakit' => 3,

            'id_petugas' => 1,
        ];

try {

    $model->simpanSemua($data);

    return redirect()
        ->to(base_url('pneumonia/input_data?success=1'));

} catch (\Throwable $e) {

    return redirect()
        ->to(base_url('pneumonia/input_data?error=1'));
}
    }

public function grafik()
{
    $data['judul'] = 'Grafik';
    $data['notif'] = $this->getNotif();
    return view('gol_c/grafik_admin', $data);
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

public function rekapskrining()
{
    $db = \Config\Database::connect();

    $builder = $db->table('skrining s');

    $builder->select('
        s.id_skrining,
        s.hasil,
        s.tanggal,
        s.id_penyakit,

        p.nik,
        p.no_hp,
        p.tanggal_lahir,
        p.nama_pasien_skrining,
        p.jenis_kelamin,
        p.usia,

        w.provinsi,
        w.kabupaten,
        w.kecamatan,
        w.kelurahan,
        w.rt,
        w.rw
    ');

    $builder->join(
        'pasien_skrining p',
        'p.id_pasien_skrining = s.id_pasien_skrining'
    );

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah'
    );

    // FILTER ID PENYAKIT = 3
    $builder->where('s.id_penyakit', 3);

    $builder->orderBy('s.id_skrining', 'DESC');

    // =========================
    // PAGINATION
    // =========================

    $perPage = 10;
    $page = (int) ($this->request->getVar('page') ?? 1);

    // total data
    $totalBuilder = clone $builder;
    $total = $totalBuilder->countAllResults(false);

    // data tabel
    $skrining = $builder
        ->limit($perPage, ($page - 1) * $perPage)
        ->get()
        ->getResultArray();

    // =========================
    // OVERVIEW
    // =========================

    // skrining hari ini
    $skriningHariIni = $db->table('skrining')
        ->where('id_penyakit', 3)
        ->where('DATE(tanggal)', date('Y-m-d'))
        ->countAllResults();

    // total seluruh skrining
    $totalSkrining = $db->table('skrining')
        ->where('id_penyakit', 3)
        ->countAllResults();

    // berisiko
    $berisiko = $db->table('skrining')
        ->where('id_penyakit', 3)
        ->where('hasil', 'Berisiko')
        ->countAllResults();

    // tidak berisiko
    $tdkberisiko = $db->table('skrining')
        ->where('id_penyakit', 3)
        ->where('hasil', 'Tidak Berisiko')
        ->countAllResults();

    // =========================
    // PAGER
    // =========================

    $pager = \Config\Services::pager();

    $pagerLinks = $pager->makeLinks(
        $page,
        $perPage,
        $total
    );

    // =========================
    // DATA VIEW
    // =========================

    $data = [
        'menu' => 'skrining',
        'judul' => 'Rekap Skrining',

        // tabel
        'skrining' => $skrining,

        // pagination
        'pagerLinks' => $pagerLinks,

        // overview
        'skriningHariIni' => $skriningHariIni,
        'totalSkrining' => $totalSkrining,
        'berisiko' => $berisiko,
        'tdkberisiko' => $tdkberisiko
    ];
    $data['notif'] = $this->getNotif();
    return view('gol_c/rekapskrining', $data);
}

// ======================
// FUNCTION ENTROPY
// ======================
private function entropy($data)
{
    $total = count($data);

    if ($total == 0) {
        return 0;
    }

    $berisiko = 0;
    $tidak = 0;

    foreach ($data as $d) {

        if ($d['hasil'] == 'Berisiko') {
            $berisiko++;
        } else {
            $tidak++;
        }
    }

    $p1 = $berisiko / $total;
    $p2 = $tidak / $total;

    $entropy = 0;

    if ($p1 > 0) {
        $entropy -= $p1 * log($p1, 2);
    }

    if ($p2 > 0) {
        $entropy -= $p2 * log($p2, 2);
    }

    return $entropy;
}

public function skriningpneumonia3()
{
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');

    $lahir = new DateTime($tanggal_lahir);
    $today = new DateTime();

    $usia = $today->diff($lahir)->y;
    $nik = $this->request->getPost('nik');
    $telepon = $this->request->getPost('telepon');

    // ======================
    // WILAYAH
    // ======================

    $provinsi  = $this->request->getPost('provinsi_nama');
    $kabupaten = $this->request->getPost('kabupaten_nama');
    $kecamatan = $this->request->getPost('kecamatan_nama');
    $kelurahan = $this->request->getPost('kelurahan_nama');

    if (
        empty($provinsi) ||
        empty($kabupaten) ||
        empty($kecamatan) ||
        empty($kelurahan)
    ) {
        return redirect()->to('/skriningpneumonia')
            ->with('error', 'Data wilayah wajib diisi');
    }

    // ======================
    // SIMPAN WILAYAH
    // ======================

    $modelWilayah = new \App\Models\wilayahskriningpneumonia();

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
            $kabupaten . ', ' .
            $provinsi
    ]);

    $id_wilayah = $modelWilayah->insertID();

    // ======================
    // SIMPAN PASIEN
    // ======================

    $modelPasien = new \App\Models\PasienPneumoniaModel();

    $modelPasien->save([
        'nik' => $nik,
        'nama_pasien_skrining' => $nama,
        'jenis_kelamin' => $jenis_kelamin,
        'tanggal_lahir' => $tanggal_lahir,
        'usia' => $usia,
        'no_hp' => $telepon,
        'created_at' => date('Y-m-d H:i:s'),
        'id_wilayah' => $id_wilayah
    ]);

    $id_pasien_skrining = $modelPasien->insertID();

    // ======================
    // LOAD DATASET CSV
    // ======================

    $datasetPath = FCPATH . 'dataset/pneumonia.csv';

    $dataTraining = [];

    if (($handle = fopen($datasetPath, "r")) !== FALSE) {

        $header = fgetcsv($handle, 1000, ";");

        while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {

            $dataTraining[] = [
                'p1'  => trim($row[0]),
                'p2'  => trim($row[1]),
                'p3'  => trim($row[2]),
                'p4'  => trim($row[3]),
                'p5'  => trim($row[4]),
                'p6'  => trim($row[5]),
                'p7'  => trim($row[6]),
                'p8'  => trim($row[7]),
                'p9'  => trim($row[8]),
                'p10' => trim($row[9]),
                'p11' => trim($row[10]),
                'hasil' => trim($row[11])
            ];
        }

        fclose($handle);
    }

    // ======================
    // INPUT USER
    // ======================

    $input = [
        'p1'  => ($this->request->getPost('p1') == 1) ? 'Iya' : 'Tidak',
        'p2'  => ($this->request->getPost('p2') == 1) ? 'Iya' : 'Tidak',
        'p3'  => ($this->request->getPost('p3') == 1) ? 'Iya' : 'Tidak',
        'p4'  => ($this->request->getPost('p4') == 1) ? 'Iya' : 'Tidak',
        'p5'  => ($this->request->getPost('p5') == 1) ? 'Iya' : 'Tidak',
        'p6'  => ($this->request->getPost('p6') == 1) ? 'Iya' : 'Tidak',
        'p7'  => ($this->request->getPost('p7') == 1) ? 'Iya' : 'Tidak',
        'p8'  => ($this->request->getPost('p8') == 1) ? 'Iya' : 'Tidak',
        'p9'  => ($this->request->getPost('p9') == 1) ? 'Iya' : 'Tidak',
        'p10' => ($this->request->getPost('p10') == 1) ? 'Iya' : 'Tidak',
        'p11' => ($this->request->getPost('p11') == 1) ? 'Iya' : 'Tidak',
    ];

    // ======================
    // HITUNG ENTROPY TOTAL
    // ======================

    $entropyTotal = $this->entropy($dataTraining);

    // ======================
    // HITUNG GAIN
    // ======================

    $gainList = [];

    for ($i = 1; $i <= 11; $i++) {

        $atribut = 'p' . $i;

        $iya = [];
        $tidak = [];

        foreach ($dataTraining as $row) {

            if ($row[$atribut] == 'Iya') {
                $iya[] = $row;
            } else {
                $tidak[] = $row;
            }
        }

        $totalData = count($dataTraining);

        $entropyIya = $this->entropy($iya);
        $entropyTidak = $this->entropy($tidak);

        $gain =
            $entropyTotal -
            ((count($iya) / $totalData) * $entropyIya) -
            ((count($tidak) / $totalData) * $entropyTidak);

        $gainList[$atribut] = $gain;
    }

    // ======================
    // ATRIBUT TERBAIK
    // ======================

    arsort($gainList);

    $atributTerbaik = array_key_first($gainList);

    // ======================
    // FILTER DATA SESUAI INPUT
    // ======================

    $matching = [];

    foreach ($dataTraining as $row) {

        if ($row[$atributTerbaik] == $input[$atributTerbaik]) {
            $matching[] = $row;
        }
    }

    // ======================
    // VOTING HASIL
    // ======================

    $jumlahBerisiko = 0;
    $jumlahTidak = 0;

    foreach ($matching as $m) {

        if ($m['hasil'] == 'Berisiko') {
            $jumlahBerisiko++;
        } else {
            $jumlahTidak++;
        }
    }

    if ($jumlahBerisiko >= $jumlahTidak) {

        $hasil = 'Berisiko Pneumonia';
        $hasilDatabase = 'Berisiko';

    } else {

        $hasil = 'Tidak Berisiko Pneumonia';
        $hasilDatabase = 'Tidak Berisiko';
    }

    // ======================
    // DETAIL
    // ======================

    $alasan =
        "Atribut terbaik: " . $atributTerbaik .
        " | Gain: " . round($gainList[$atributTerbaik], 4) .
        " | Berisiko: " . $jumlahBerisiko .
        " | Tidak Berisiko: " . $jumlahTidak;

    // ======================
    // VARIABEL SAVE
    // ======================

    $p1  = $input['p1'];
    $p2  = $input['p2'];
    $p3  = $input['p3'];
    $p4  = $input['p4'];
    $p5  = $input['p5'];
    $p6  = $input['p6'];
    $p7  = $input['p7'];
    $p8  = $input['p8'];
    $p9  = $input['p9'];
    $p10 = $input['p10'];
    $p11 = $input['p11'];

    // ======================
    // SIMPAN HASIL SKRINING
    // ======================

    $modelSkrining = new \App\Models\SkriningPneumoniaModel();

    $modelSkrining->save([

        'id_pasien_skrining' => $id_pasien_skrining,
        'id_penyakit' => 3,
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

        'hasil' => $hasilDatabase
    ]);

    // ======================
    // KIRIM KE VIEW
    // ======================

    $data = $this->request->getPost();

    $data['provinsi'] = $provinsi;
    $data['kabupaten'] = $kabupaten;
    $data['kecamatan'] = $kecamatan;
    $data['kelurahan'] = $kelurahan;
 
    $data['hasil'] = $hasil;
    $data['alasan'] = $alasan;

    $data['gainList'] = $gainList;
    $data['atributTerbaik'] = $atributTerbaik;

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