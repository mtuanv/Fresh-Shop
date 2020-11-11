<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Image extends Model
{
    use HasFactory;
    use softDeletes;
    public function products() {
      return $this->belongsTo('App\Models\Product');
    }
}
