<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'guard_name', 'action_id', 'menu_id'];
    public function action()
    {
        return $this->belongsTo(Action::class, "action_id", "action")->withDefault([
            'name' => '-',
        ]);
    }
}
