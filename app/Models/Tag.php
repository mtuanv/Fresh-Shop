<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Tag extends Model
{
    use HasFactory;
    use softDeletes;
    public function products(){
      return $this->belongsToMany('App\Models\Product', 'product_tags');
    }
}
