<?php

namespace App\Models;

use CodeIgniter\Model;

class ParkirModel extends Model
{
    protected $table         = 'parkir';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['plat_nomor', 'jenis_kendaraan', 'waktu_masuk', 'waktu_keluar','durasi', 'biaya'];
    protected $useTimestamps = false; 
    protected $returnType    = 'array'; 
}



