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
            'no_rm' => $this->request->getPost('no_rm'),
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan'),
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

            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'no_rm' => $this->request->getPost('no_rm'),
            'nama_pasien' => $this->request->getPost('nama_pasien'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tgl_kunjungan' => $this->request->getPost('tgl_kunjungan'),
            'ctt_klinis' => $this->request->getPost('ctt_klinis'),

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
        $pasien = $this->pasienModel->findAll();

        // ================= WILAYAH =================
        $mappingWilayah = [

            1 => 'Jemberkidul',
            2 => 'Tegalbesar',
            3 => 'Kaliwates',
            4 => 'Kebonagung',
            5 => 'Sempusari',
            6 => 'Mangli',
            7 => 'Kepatihan'

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
        
        return view('gol_b/grafik/index', $data);
    }
}