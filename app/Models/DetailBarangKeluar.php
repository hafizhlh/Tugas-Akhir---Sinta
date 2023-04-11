<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    protected $table = 'detail_barang_keluars';
    protected $primaryKey = 'detail_barang_keluar_id';
    protected $fillable = [
        'barang_keluar_id',
        'barang_id',        
        'jumlah_barang_keluar',
        'delete_mark'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'barang_id');
    }

    public function barang_keluar()
    {
        return $this->belongsTo('App\Models\BarangKeluar', 'barang_keluar_id', 'barang_keluar_id');
    }
}
