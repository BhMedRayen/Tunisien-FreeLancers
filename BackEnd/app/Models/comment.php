<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function Posts(){
        return $this->belongsToMany(post::class);
    }
}
