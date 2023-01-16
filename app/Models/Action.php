<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    //
    protected $table='action';
    public $incrementing = false;
    protected $fillable=['id','action_name'];

}
