<?php

namespace App\Models;

use CodeIgniter\Model;

class DiareModel extends Model
{
    protected $table = 'diare';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $protectFields = true;

    protected $allowedFields = [
        'nama',
        'desa',
        'kasus',
        'kategori'
    ];

    // timestamps (opsional tapi bagus)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /*
    =========================
    CUSTOM FUNCTION 🔥
    =========================
    */

    // ambil semua data
    public function getAllData()
    {
        return $this->findAll();
    }

    // ambil berdasarkan desa (buat peta nanti)
    public function getByDesa($desa)
    {
        return $this->where('desa', $desa)->first();
    }

    // ambil data unik desa (buat dropdown/filter)
    public function getDesaList()
    {
        return $this->select('desa')
                    ->groupBy('desa')
                    ->findAll();
    }
}