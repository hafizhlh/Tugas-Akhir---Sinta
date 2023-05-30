<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable 
{
    use Notifiable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use Impersonate;
    use \App\Traits\UuidKey;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primary_key = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = [
        'username', 'email', 'password','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'old_values'   => 'json',
        'new_values'   => 'json',
        // 'auditable_id' => 'string',
    ];
}
