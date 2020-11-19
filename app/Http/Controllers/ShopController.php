<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
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
        return view('welcome')->with(['lsTag' => $lsTag, 'lsProduct' => $lsProduct]);
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

    public function menu(Request $request)
    {
        $name = $request->name;
        if ($name != null) {
            $lsProduct = Product::where('products.name', 'like', '%' . $name . '%')->paginate(9);
            $lsPr = Product::where('products.name', 'like', '%' . $name . '%')->paginate(3);
            $lsTag = Tag::all();
        } else {
            $lsProduct = Product::paginate(9);
            $lsPr = Product::paginate(3);
            $lsTag = Tag::all();
        }
        return view('menu')->with(['lsProduct' => $lsProduct, 'lsPr' => $lsPr, 'lsTag' => $lsTag, 'name' => $name]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $lsProduct = Product::all();
        $lsTag = Tag::all();
        return view('detail')->with(['product' => $product, 'lsProduct' => $lsProduct, 'lsTag' => $lsTag]);
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:5',
            'phone' => 'required',
            'content' => 'required'
        ]);
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->rating = $request->rating;
        $feedback->phone = $request->phone;
        $feedback->content = $request->content;
        $feedback->product_id = $request->product_id;
        $feedback->save();

        return response()->json(['msg' => 'Success']);

    }
}
