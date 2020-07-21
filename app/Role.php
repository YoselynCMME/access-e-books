<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Role extends Model
{
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
