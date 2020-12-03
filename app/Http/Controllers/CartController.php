<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
Use App\Cart;
Use Session;

class CartController extends Controller
{
    public function AddCart(Request $req ,$id) {
      $product = DB::table('products')->where('id',$id)->first();
      if($product != null) {
          $oldCart = Session('Cart') ? Session('Cart') : null;
          $newCart = new Cart($oldCart);
          $newCart->AddCart($product, $id);

          $req->session()->put('Cart', $newCart);
      }
      return view('cartitems', compact('newCart'));
    }

    public function DeleteItemCart(Request $req ,$id) {
          $oldCart = Session('Cart') ? Session('Cart') : null;
          $newCart = new Cart($oldCart);
          $newCart->DeleteItemCart($id);

          if(Count($newCart->products) > 0 ){
            $req->session()->put('Cart', $newCart);
          }else {
            $req->session()->forget('Cart');
          }
          return view('cartitems', compact('newCart'));        
    }
}
