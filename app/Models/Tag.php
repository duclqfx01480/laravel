<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // 72. Polymorphic Relation - Many to Many
    public function posts(){
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    // 72. Polymorphic Relation - Many to Many
    public function videos(){
        return $this->morphedByMany('App\Models\Video', 'taggable');
    }
}
