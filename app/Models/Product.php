<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use HasFactory;
    use softDeletes;

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tags');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'product_orders');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }
}
