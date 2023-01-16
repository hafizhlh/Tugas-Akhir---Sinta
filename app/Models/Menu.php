<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table    = 'menu';
    protected $fillable = ['id', 'uuid', 'name', 'url', 'order_no', 'permission' ,'icon', 'parent_id', 'status', 'created_by', 'updated_by'];

    public function menuChilds()
    {
        return $this->hasMany("App\Models\Menu", "parent_id", "id");
    }

    public function permissionmenu()
    {
        return $this->hasMany("App\Models\Permission","menu_id","id");
    }
    
}
