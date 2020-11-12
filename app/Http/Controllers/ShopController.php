<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
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
        return view('aboutus');

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
        return view('menu');
    }

    public function detail()
    {
        return view('detail');
    }
}
