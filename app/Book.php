<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Page;

class Book extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
