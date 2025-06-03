<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table = 'keuangan'; // Ganti sesuai nama tabel
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis', 'jumlah', 'tanggal', 'deskripsi']; // Sesuaikan

    // Mengambil total saldo (pemasukan - pengeluaran)
    public function getTotalSaldo()
    {
        $pemasukan = $this->where('jenis', 'pemasukan')->selectSum('jumlah')->first()['jumlah'] ?? 0;
        $pengeluaran = $this->where('jenis', 'pengeluaran')->selectSum('jumlah')->first()['jumlah'] ?? 0;

        return $pemasukan - $pengeluaran;
    }

    public function getTotalPemasukan()
    {
        return $this->where('jenis', 'pemasukan')->selectSum('jumlah')->first()['jumlah'] ?? 0;
    }

    public function getTotalPengeluaran()
    {
        return $this->where('jenis', 'pengeluaran')->selectSum('jumlah')->first()['jumlah'] ?? 0;
    }
}
