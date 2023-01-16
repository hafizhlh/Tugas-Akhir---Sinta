<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    //
    protected $table="routes";
    protected $fillable=['id','method','url','route','guard','type','middleware','permission','created_at','updated_at','created_by','updated_by'];
}
