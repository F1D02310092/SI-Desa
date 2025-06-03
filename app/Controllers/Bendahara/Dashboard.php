<?php

namespace App\Controllers\Bendahara;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;

class Dashboard extends BaseController
{
    protected $keuanganModel;

    public function __construct()
    {
        $this->keuanganModel = new KeuanganModel();
    }

    public function index()
    {
        // Cek session dan level user
        if (!session()->get('isLoggedIn') || session()->get('level') !== 'bendahara') {
            return redirect()->to('/login');
        }

        // Hitung total pemasukan dan pengeluaran
        $totalPemasukan = $this->keuanganModel
            ->where('jenis', 'pemasukan')
            ->selectSum('jumlah')
            ->first()['jumlah'] ?? 0;

        $totalPengeluaran = $this->keuanganModel
            ->where('jenis', 'pengeluaran')
            ->selectSum('jumlah')
            ->first()['jumlah'] ?? 0;

        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Ambil 5 transaksi terbaru
        $transaksiTerbaru = $this->keuanganModel
            ->orderBy('tanggal', 'DESC')
            ->findAll(5);

        $data = [
            'title' => 'Dashboard Bendahara',
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_akhir' => $saldoAkhir,
            'transaksi_terbaru' => $transaksiTerbaru
        ];

        return view('bendahara/dashboard', $data);
    }
}
