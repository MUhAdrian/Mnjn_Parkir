<?php

namespace App\Models;

use CodeIgniter\Model;

class TarifModel extends Model
{
    protected $table         = 'tarif';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['jenis_kendaraan', 'tarif_per_jam'];
    protected $useTimestamps = false; 
    protected $returnType    = 'array'; 
}

