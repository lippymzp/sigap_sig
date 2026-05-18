<?php

namespace App\Controllers\AdminTbc;

use App\Controllers\BaseController;
use App\Models\PasienModel;

class Pasien extends BaseController
{
    protected PasienModel $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    // ================= DATA PASIEN =================
    public function index()
{
    $data = [

        'pasien' => $this->pasienModel->findAll(),

        'jumlah_sembuh' =>
            $this->pasienModel
            ->where('status_akhir', 'Sembuh')
            ->countAllResults(),

        'jumlah_pengobatan' =>
            $this->pasienModel
            ->where('status_akhir', 'Pengobatan')
            ->countAllResults(),

        'jumlah_meninggal' =>
            $this->pasienModel
            ->where('status_akhir', 'Meninggal')
            ->countAllResults(),

        'menu' => 'hasil',
        'judul' => 'Hasil Data Pasien'
    ];

    return view('gol_b/data-pasien/data_pasien', $data);
}

    // ================= FORM INPUT =================
    public function create()
    {
        return view('gol_b/data-pasien/create', [
            'menu' => 'inputdata',
            'judul' => 'Input Data Pasien'
        ]);
    }

    // ================= SIMPAN DATA =================
    public function store()
    {
        $rules = [
            'no_rm' => 'required|is_unique[pasien.no_rm]',
        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'No RM sudah digunakan!');
        }

        $this->pasienModel->save([

            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'nik' => $this->request->getPost('nik'),
            'no_rm' => $this->request->getPost('no_rm'),
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan'),
            'status_akhir' => $this->request->getPost('status_akhir'),
            'ctt_klinis' => $this->request->getPost('ctt_klinis'),
            'id_petugas' => 3

        ]);

        return redirect()->to('/tbc/hasil');
    }

    // ================= EDIT =================
    public function edit(int $id)
    {
        $data = [
            'pasien' => $this->pasienModel->find($id),
            'judul' => 'Edit Data Pasien',
            'menu' => 'hasil'
        ];

        return view('gol_b/data-pasien/edit', $data);
    }

    // ================= UPDATE =================
public function update(int $id)
{
    $this->pasienModel->update($id, [

        // ===== WILAYAH =====
        'id_wilayah'     => $this->request->getPost('id_wilayah'),
        'provinsi'       => $this->request->getPost('provinsi'),
        'kabupaten'      => $this->request->getPost('kabupaten'),
        'kecamatan'      => $this->request->getPost('kecamatan'),
        'rt'             => $this->request->getPost('rt'),
        'rw'             => $this->request->getPost('rw'),
        'alamat_lengkap' => $this->request->getPost('alamat'),
        'latitude'       => $this->request->getPost('lat'),
        'longitude'      => $this->request->getPost('lng'),

        // ===== DATA PASIEN =====
        'nik'            => $this->request->getPost('nik'),
        'no_rm'          => $this->request->getPost('no_rm'),
        'nama_pasien'    => $this->request->getPost('nama_pasien'),
        'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
        'tgl_lahir'      => $this->request->getPost('tanggal_lahir'),
        'umur'           => $this->request->getPost('umur'),
        'tgl_kunjungan'  => $this->request->getPost('tgl_kunjungan'),
        'status_akhir'   => $this->request->getPost('status_akhir'),
        'ctt_klinis'     => $this->request->getPost('ctt_klinis'),

    ]);

    return redirect()->to('/tbc/hasil');
}
    

    // ================= DELETE =================
    public function delete(int $id)
    {
        $this->pasienModel->delete($id);

        return redirect()->to('/tbc/hasil');
    }

    // ================= GRAFIK =================
    public function grafik()
    {
        $db = \Config\Database::connect();
        $pasien = $this->pasienModel->findAll();

        // ================= WILAYAH =================
        $mappingWilayah = [

            2001 => 'Jemberkidul',
            2002 => 'Tegalbesar',
            2003 => 'Kaliwates',
            2004 => 'Kebonagung',
            2005 => 'Sempusari',
            2006 => 'Mangli',
            2007 => 'Kepatihan'

        ];

        $wilayah = [

            'Jemberkidul',
            'Tegalbesar',
            'Kaliwates',
            'Kebonagung',
            'Sempusari',
            'Mangli',
            'Kepatihan',
            'Lainnya'

        ];

        // ================= BULAN =================
        $bulanList = [

            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12'

        ];

        // ================= KATEGORI UMUR =================
        $kategori = [

            'Balita',
            'Anak-anak',
            'Remaja',
            'Dewasa',
            'Lansia'

        ];

        // ================= DEFAULT DATA =================
        $grafik = [];

        foreach($bulanList as $b){

            foreach($kategori as $k){

                foreach($wilayah as $w){

                    $grafik[$b]['laki'][$k][$w] = 0;
                    $grafik[$b]['perempuan'][$k][$w] = 0;

                }

            }

        }

        // ================= LOOP DATA PASIEN =================
        foreach($pasien as $p){

            // ===== umur =====
            $umur = (int)$p['umur'];

            if($umur <= 4){

                $kategoriUmur = 'Balita';

            } elseif($umur <= 9){

                $kategoriUmur = 'Anak-anak';

            } elseif($umur <= 18){

                $kategoriUmur = 'Remaja';

            } elseif($umur <= 59){

                $kategoriUmur = 'Dewasa';

            } else {

                $kategoriUmur = 'Lansia';

            }

            if($p['jenis_kelamin'] == 'Perempuan'){
            $gender = 'perempuan';
            }else{
                $gender = 'laki';
            }

            // ===== bulan =====
            $kodeBulan =
            date(
                'm',
                strtotime($p['tgl_kunjungan'])
            );

            $bulan = $kodeBulan;

            // ===== wilayah =====
            $idWilayah = $p['id_wilayah'];

            $namaWilayah =
            $mappingWilayah[$idWilayah]
            ?? 'Lainnya';

            // ===== tambah data =====
            $grafik
            [$bulan]
            [$gender]
            [$kategoriUmur]
            [$namaWilayah]++;

        }

        $data = [

            'grafik' => json_encode($grafik),

            'wilayah' => json_encode($wilayah),

            'bulan' => json_encode($bulanList)

        ];

        $data['jumlah_sembuh'] = $db->table('pasien') ->where('status_akhir','Sembuh') ->countAllResults();

        $data['jumlah_pengobatan'] = $db->table('pasien') ->where('status_akhir','Pengobatan') ->countAllResults();

        $data['jumlah_meninggal'] = $db->table('pasien') ->where('status_akhir','Meninggal') ->countAllResults();
        
        return view('gol_b/grafik/index', $data);
    }
        public function export()
    {
        return view('gol_b/export/export_data');
    }
    public function getTahunList()
    {
        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT DISTINCT YEAR(tgl_kunjungan) as tahun
            FROM pasien
            ORDER BY tahun DESC
        ");

        return $this->response->setJSON(
            $query->getResult()
        );
    }


public function exportPage()
{
    return view('gol_b/grafik/index');
}
public function exportData()
{
    $type = $this->request->getGet('type');

    $pasienModel = new \App\Models\PasienModel();

    $data['pasien'] = $pasienModel
    ->select('pasien.*, wilayah.kelurahan')
    ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
    ->findAll();

    // ================= EXCEL =================
    if($type == 'excel'){

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_pasien.xls");

        echo view('gol_b/export/excel', $data);
    }

    // ================= PDF =================
    else{

        echo view('gol_b/export/pdf', $data);
    }
}
}