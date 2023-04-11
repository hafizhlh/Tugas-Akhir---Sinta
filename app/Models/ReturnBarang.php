<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnBarang extends Model
{
    protected $table = 'return_barangs';
    protected $primaryKey = 'return_id';
    protected $fillable = [
        'return_id',
        'user_id',
        'barang_keluar_id',
        'waktu_return',
        'delete_mark',
    ];
}
