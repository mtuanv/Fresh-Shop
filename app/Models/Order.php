<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Order extends Model
{
    use HasFactory;
    use softDeletes;
    public function products(){
      return $this->belongsToMany('App\Models\Product', 'product_orders');
    }
    public function order_products(){
      return $this->hasMany('App\Models\ProductOrder');
    }
    public function user(){
      return $this->belongsTo('App\Models\User');
    }
}
