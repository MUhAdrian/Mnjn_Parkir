<?php

namespace App\Controllers;

use App\Models\ParkirModel;
use App\Models\TarifModel;
use CodeIgniter\Controller; 

class Parkir extends BaseController
{
    protected $parkirModel;
    protected $tarifModel;

    public function __construct()
    {
        $this->parkirModel = new ParkirModel();
        $this->tarifModel  = new TarifModel();

        date_default_timezone_set('Asia/Jakarta'); 

    }

    /**
     * Menampilkan form untuk kendaraan masuk.
     */
    public function formMasuk()
    {
        return view('parkir/masuk');
    }

    /**
     * Menyimpan data kendaraan yang masuk.
     */
     public function simpanMasuk()
    {
        $rules = [
            'plat_nomor' => 'required|min_length[3]|max_length[20]',
            'jenis_kendaraan' => 'required|in_list[roda_2,roda_4]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Pastikan format waktu benar
        $waktu_masuk = date('Y-m-d H:i:s');
        
        $data = [
            'plat_nomor' => strtoupper($this->request->getVar('plat_nomor')),
            'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
            'waktu_masuk' => $waktu_masuk,
            'waktu_keluar' => null
        ];
           
        log_message('debug', 'Waktu masuk: '.$waktu_masuk);
        $this->parkirModel->save($data);
        return redirect()->to('/parkir/masuk')->with('message', 'Data berhasil disimpan');
    }


   public function formKeluar()
    {
        $data['parkir'] = $this->parkirModel->where('waktu_keluar', null)->findAll();
        return view('parkir/keluar', $data);
    }


   

    public function simpanKeluar()
    {
        $id = $this->request->getVar('id');
        $parkir = $this->parkirModel->find($id);

        if (!$parkir) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Ambil waktu sekarang
        $waktu_keluar = date('Y-m-d H:i:s');
        
        // Hitung durasi
        $waktu_masuk = strtotime($parkir['waktu_masuk']);
        $waktu_keluar_timestamp = strtotime($waktu_keluar);
        $durasi = $waktu_keluar_timestamp - $waktu_masuk;
        
        
        if ($durasi < 0) {
            $durasi = 0;
        }
        
        
        $durasi_jam = ceil($durasi / 3600); 
        
        
        $tarif = $this->tarifModel->where('jenis_kendaraan', $parkir['jenis_kendaraan'])->first();
        
        if (!$tarif) {
            return redirect()->back()->with('error', 'Tarif tidak ditemukan');
        }
        
        $biaya = $durasi_jam * $tarif['tarif_per_jam'];

        $data = [
            'waktu_keluar' => $waktu_keluar,
            'durasi' => $durasi,
            'biaya' => $biaya
        ];

        $this->parkirModel->update($id, $data);
        return redirect()->to('/parkir/keluar')->with('message', 'Kendaraan berhasil keluar');
    }
}




