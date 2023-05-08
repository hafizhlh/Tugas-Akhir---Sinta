<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuks';
    protected $primaryKey = 'barang_masuk_id';
    protected $fillable = [
        'tanggal_barang_masuk',
        'delete_mark',
    ];
    public $timestamps = false;
}
