<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidKey;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Company extends Model
{
    use UuidKey;
    use SoftDeletes;

    protected $table    = 'company';
    protected $fillable = ['company_code', 'company_name', 'parent_company_code'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getCompanyParentID(){
        return DB::table('company AS t1')->select('t2.id','t1.parent_company_code', 't2.company_name')->leftJoin("company as t2", "t1.parent_company_code", "=", "t2.company_code")->groupBy('t1.parent_company_code', 't2.company_name', 't2.id');
    }
}
