<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barang';
    protected $primaryKey = 'stok_barang_id';
    protected $fillable = [
        'stok_barang_id',
        'barang_id',
        'masuk',
        'keluar',
        'transaksi_id',
        'jenis_barang',
        'tanggal',
        'saldo',
        'delete_mark',
    ];
}
