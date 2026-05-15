<?php
namespace App\Controllers\AdminTbc;
use App\Controllers\BaseController;
class Wilayah extends BaseController
{
    public function kabupaten($provId)
    {
        $db = \Config\Database::connect(); // atau 'default' kalau satu DB
        $data = $db->table('cities')
            ->where('prov_id', $provId)
            ->orderBy('city_name', 'ASC')
            ->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    public function kecamatan($cityId)
    {
        $db = \Config\Database::connect();
        $data = $db->table('districts')
            ->where('city_id', $cityId)
            ->orderBy('dis_name', 'ASC')
            ->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    public function kelurahan($disId)
    {
        $db = \Config\Database::connect();
        $data = $db->table('subdistricts')
            ->where('dis_id', $disId)
            ->orderBy('subdis_name', 'ASC')
            ->get()->getResultArray();

        return $this->response->setJSON($data);
    }
}