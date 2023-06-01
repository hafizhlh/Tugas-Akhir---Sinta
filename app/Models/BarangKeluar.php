<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluars';
    protected $primaryKey = 'barang_keluar_id';
    protected $fillable =[
        'barang_keluar_id',
        'user_id',
        'tgl_pengambilan',
        'no_dof_etiket',
        'keterangan',
        'delete_mark',
    ];
    // timestamps false
    public $timestamps = false;
}
