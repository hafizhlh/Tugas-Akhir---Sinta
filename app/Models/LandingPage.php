<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $table = 'landing_page';
    protected $fillable = [
        'id',
        'uuid',
        'urutan',
        'judul',
        'gambar',
        'url',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'delete_mark',
    ];
}
