<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'keuangan'; // Asumsi: transaksi tercatat di tabel yang sama
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis', 'jumlah', 'tanggal', 'deskripsi'];

    public function getRecent($limit = 10)
    {
        return $this->orderBy('tanggal', 'DESC')->findAll($limit);
    }
}
