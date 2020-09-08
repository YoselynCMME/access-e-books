<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;

class Link extends Model
{
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
