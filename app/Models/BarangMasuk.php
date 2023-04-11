<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'barang_masuk_id';
    protected $fillable = [
        'barang_masuk_id',
        'tanggal_barang_masuk',        
        'delete_mark',
    ];
}
