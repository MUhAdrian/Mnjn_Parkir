<?php

namespace App\Controllers;

use App\Models\TarifModel;
use CodeIgniter\Controller; 

class Tarif extends BaseController
{
    protected $tarifModel;

    public function __construct()
    {
        $this->tarifModel = new TarifModel();
    }

    /**
     * Menampilkan halaman pengaturan tarif parkir.
     */
    public function index()
    {
        $data['tarif'] = $this->tarifModel->findAll();

        return view('tarif/edit', $data);
    }

    /**
     * Memperbarui tarif parkir.
     */
    public function update()
    {

        $tarifData = $this->request->getPost('tarif');

        // Inisialisasi aturan validasi
        $rules = [];
        if (!empty($tarifData)) {
            foreach ($tarifData as $id => $tarif) {
                $rules["tarif.{$id}"] = 'required|numeric|greater_than_equal_to[0]';
            }
        } else {
            
        }

       
        if (! $this->validate($rules)) {
            
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        
        foreach ($tarifData as $id => $tarif) {
            $this->tarifModel->update($id, ['tarif_per_jam' => $tarif]);
        }

        
        return redirect()->to('/tarif')->with('success', 'Tarif parkir berhasil diperbarui.');
    }
}
