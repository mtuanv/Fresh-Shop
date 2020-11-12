<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Promotion extends Model
{
    use HasFactory;
    use softDeletes;

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'promotion_tags');
    }
}
