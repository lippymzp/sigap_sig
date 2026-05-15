<?php

namespace App\Models;

use CodeIgniter\Model;

class SkriningModelD extends Model
{
    protected $table = 'skrining';
    protected $primaryKey = 'id_skrining';

    protected $allowedFields = [
        'id_pasien_skrining',
        'id_penyakit',
        'tanggal',
        'var1',
        'var2',
        'var3',
        'var4',
        'var5',
        'var6',
        'var7',
        'var8',
        'var9',
        'var10',
        'var11',
        'var12',
        'var13',
        'var14',
        'var15'
    ];
}