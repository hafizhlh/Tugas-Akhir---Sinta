<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    protected $table = 'detail_barang_masuks';
    protected $primaryKey = 'detail_barang_masuk_id';
    protected $fillable = [
        'barang_masuk_id',
        'barang_id',
        'jumlah_barang_masuk',
        'delete_mark'
    ];
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'barang_id');
    }

    public function barang_masuk()
    {
        return $this->belongsTo('App\Models\BarangMasuk', 'barang_masuk_id', 'barang_masuk_id');
    }
}
