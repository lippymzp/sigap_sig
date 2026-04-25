<?php

namespace App\Controllers;

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

    public function simpan()
    {
        $data = [
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa'      => $this->request->getPost('desa'),
            'jk'        => $this->request->getPost('jk'),
            'usia'      => $this->request->getPost('usia'),
        ];

        $pasien = session()->get('pasien') ?? [];

        $pasien[] = $data;

        session()->set('pasien', $pasien);

        return redirect()->to('/dbd/hasil');
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
}
