<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $lsProduct = Product::all();
        $lsTag = Tag::all();
        return view('welcome')->with(['lsTag' => $lsTag, 'lsProduct' => $lsProduct]);;
    }

    public function about()
    {
        $lsUser = User::all();
        return view('aboutus')->with(['lsUser' => $lsUser]);

    }

    public function blog()
    {
        return view('blog');
    }

    public function contact()
    {
        return view('contactus');
    }

    public function cart()
    {
        return view('cart');
    }

    public function menu()
    {
        $lsProduct = Product::paginate(9);
        $lsPr = Product::paginate(3);
        $lsTag = Tag::all();
        return view('menu')->with(['lsProduct' => $lsProduct, 'lsPr' => $lsPr, 'lsTag' => $lsTag]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('detail')->with(['product' => $product]);
    }
}
