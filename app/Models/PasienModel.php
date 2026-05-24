<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [

'id_wilayah','id_penyakit','no_rm','nik','nama_pasien',
        'jenis_kelamin','tgl_lahir','umur','tgl_kunjungan','status_akhir','ctt_klinis','id_petugas'
    ];
}