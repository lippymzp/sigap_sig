<?php

namespace App\Models;

use CodeIgniter\Model;

class DataDiareModel extends Model
{
    protected $table = 'data_diare';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_pasien',
        'desa',
        'tanggal_kunjungan',
        'diagnosis',
        'jk',
        'usia',
        'catatan',
        'kecamatan'
    ];
}