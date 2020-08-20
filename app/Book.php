<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Page;

class Book extends Model
{
    protected $fillable = [
        'category', 'level', 'code', 'book', 'role_id', 'slug', 'link_lessons', 'link_games'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
