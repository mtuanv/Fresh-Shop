<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

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
        $lsBlog = Promotion::all();
        return view('blog')->with(['lsBlog' => $lsBlog]);
    }

    public function blogDetail($id)
    {
        $blog = Promotion::find($id);
        $lsTag = Tag::all();
        return view('blogDetail')->with(['blog' => $blog, 'lsTag' => $lsTag]);
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
        $count = 0;
        if ($name != null) {
            $lsProduct = Product::where('products.name', 'like', '%' . $name . '%');
            $count = $lsProduct->count();
            if ($count == 0) {
                $lsProduct = null;
            } else {
                $lsProduct = Product::where('products.name', 'like', '%' . $name . '%')->paginate(9);
                $lsProductLH = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price')->paginate(9);
                $lsProductHL = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price', 'DESC')->paginate(9);

                $lsPr = Product::where('products.name', 'like', '%' . $name . '%')->paginate(3);
                $lsPrLH = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price')->paginate(3);
                $lsPrHL = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price', 'DESC')->paginate(3);

                $lsTag = Tag::all();
            }
        } else {
            $lsProduct = Product::paginate(9);
            $lsProductLH = Product::orderBy('price')->paginate(9);
            $lsProductHL = Product::orderBy('price', 'DESC')->paginate(9);

            $lsPr = Product::paginate(3);
            $lsPrLH = Product::orderBy('price')->paginate(3);
            $lsPrHL = Product::orderBy('price', 'DESC')->paginate(3);

            $lsTag = Tag::all();
        }
        return view('menu')->with(['lsProduct' => $lsProduct, 'lsPr' => $lsPr, 'lsTag' => $lsTag, 'name' => $name, 'lsProductLH' => $lsProductLH, 'lsProductHL' => $lsProductHL, 'lsPrLH' => $lsPrLH, 'lsPrHL' => $lsPrHL]);
    }

    public function slideFilter(Request $request)
    {
        $name = $request->name;
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $lsProduct = Product::where('products.price', '>', $min, 'and', 'products.price', '<', $max)->paginate(9);
        $lsPr = Product::where('products.price', '>', $min, 'and', 'products.price', '<', $max)->paginate(3);
        $lsTag = Tag::all();

        return view('menu')->with(['lsProduct' => $lsProduct, 'lsPr' => $lsPr, 'name' => $name, 'lsTag' => $lsTag]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $lsProduct = Product::all();
        $lsFb = Feedback::where('feedback.product_id', '=', $id)->orderBy('created_at', 'desc')->paginate(5);
        $lsTag = Tag::all();
        return view('detail')->with(['product' => $product, 'lsProduct' => $lsProduct, 'lsTag' => $lsTag, 'lsFb' => $lsFb]);
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'content' => 'required'
        ]);
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->rating = $request->rating;
        $feedback->contact = $request->contact;
        $feedback->content = $request->content;
        $feedback->product_id = $request->product_id;
        $feedback->save();

        return response()->json(['msg' => 'Success']);

    }

    public function searchHeader(Request $request)
    {
        $search = $request->search;
        $count = 0;
        if ($search == null) {
            $lsProduct = Product::all();
        } elseif ($search != null) {
            $lsProduct = Product::where('products.name', 'like', '%' . $search . '%');
            $count = $lsProduct->count();
            if ($count == 0) {
                $lsProduct = null;
            } else {
                $lsProduct = Product::where('products.name', 'like', '%' . $search . '%')->paginate(9);
            }
        }
        return view('search')->with(['lsProduct' => $lsProduct, 'search' => $search]);
    }
}
