<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // 72. Polymorphic Relation - Many to Many
    public function tags(){
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
