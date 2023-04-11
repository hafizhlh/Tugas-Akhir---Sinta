<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReturnBarang extends Model
{
    protected $table = 'detail_return_barangs';
    protected $primaryKey = 'detail_return_id';
    protected $fillable = [
        'return_id',
        'barang_id',
        'jumlah_barang_return',
        'delete_mark'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'barang_id');
    }

    public function return_barang()
    {
        return $this->belongsTo('App\Models\ReturnBarang', 'return_id', 'return_id');
    }
}
