<?php

namespace App\Controllers;

use App\Models\ParkirModel;
use CodeIgniter\Controller; 

class Laporan extends BaseController
{
    protected $parkirModel;

    public function __construct()
    {
        $this->parkirModel = new ParkirModel();
    }

    /**
     * Menampilkan laporan transaksi parkir yang sudah selesai.
     */
    public function index()
    {
        $data['transaksi'] = $this->parkirModel
            ->where('waktu_keluar IS NOT NULL')
            ->orderBy('waktu_masuk', 'DESC')
            ->findAll();

        return view('laporan/index', $data);
    }

    /**
     * Menampilkan laporan transaksi parkir berdasarkan filter tanggal.
     */
    public function filter()
    {
        $data = [];
        $dari   = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');

        // Memastikan kedua tanggal filter ada
        if ($dari && $sampai) {
            $data['transaksi'] = $this->parkirModel
                ->where('DATE(waktu_keluar) >=', $dari)
                ->where('DATE(waktu_keluar) <=', $sampai)
                ->where('waktu_keluar IS NOT NULL') 
                ->orderBy('waktu_keluar', 'DESC')
                ->findAll();

            $data['dari']   = $dari;
            $data['sampai'] = $sampai;
        }

        return view('laporan/filter', $data);
    }
}

