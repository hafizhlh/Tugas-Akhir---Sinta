<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    protected $table = 'barangs';
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'user_id',
        'nama_barang',
        'jenis_barang',
        'kategori_id',
        'keterangan_barang',
        'barcode_barang',
    ];
}
