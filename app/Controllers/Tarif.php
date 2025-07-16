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
        // Ambil hanya data tarif dari POST.
        // Nama input di view diubah menjadi name="tarif[ID_TARIF]"
        // sehingga kita bisa mengambilnya sebagai array terpisah.
        $tarifData = $this->request->getPost('tarif');

        // Inisialisasi aturan validasi
        $rules = [];
        if (!empty($tarifData)) {
            foreach ($tarifData as $id => $tarif) {
                // Aturan validasi untuk setiap input tarif.
                // Gunakan notasi titik "tarif.{$id}" untuk validasi array.
                $rules["tarif.{$id}"] = 'required|numeric|greater_than_equal_to[0]';
            }
        } else {
            // Jika tidak ada data tarif yang dikirim (misalnya form kosong),
            // tambahkan aturan untuk memastikan setidaknya ada satu input.
            // Atau Anda bisa menangani ini sebagai error "tidak ada data untuk diupdate".
            // Untuk kasus ini, kita asumsikan form selalu mengirimkan data tarif.
        }

        // Lakukan validasi
        if (! $this->validate($rules)) {
            // Jika validasi gagal, kembalikan pengguna ke halaman sebelumnya
            // dengan input yang sudah diisi dan pesan error.
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Jika validasi berhasil, lakukan pembaruan data
        foreach ($tarifData as $id => $tarif) {
            $this->tarifModel->update($id, ['tarif_per_jam' => $tarif]);
        }

        // Redirect ke halaman tarif dengan pesan sukses
        return redirect()->to('/tarif')->with('success', 'Tarif parkir berhasil diperbarui.');
    }
}
