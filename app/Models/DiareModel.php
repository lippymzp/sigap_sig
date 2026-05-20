<?php

namespace App\Models;

use CodeIgniter\Model;

class DiareModel extends Model
{
    protected $table = 'data_diare_1';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $protectFields = true;

    protected $allowedFields = [
        'nama_pasien',
        'desa',
        'tanggal_kunjungan',
        'diagnosis'
    ];

    // JANGAN pakai timestamps karena tabel data_diare tidak punya created_at / updated_at
    protected $useTimestamps = false;

    /*
    =========================
    CUSTOM FUNCTION
    =========================
    */

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getByDesa($desa)
    {
        return $this->where('desa', $desa)->findAll();
    }

    public function getDesaList()
    {
        return $this->select('desa')
                    ->groupBy('desa')
                    ->findAll();
    }
}