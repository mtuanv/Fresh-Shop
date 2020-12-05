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
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $lsProduct = Product::all();
        $lsTag = Tag::all();
        $lsBlog = Promotion::all();
        return view('welcome')->with(['lsTag' => $lsTag, 'lsProduct' => $lsProduct, 'lsBlog' => $lsBlog]);
    }

    public function about()
    {
        $lsUser = User::all();
        $lsBlog = Promotion::all();
        return view('aboutus')->with(['lsUser' => $lsUser, 'lsBlog' => $lsBlog]);

    }

    public function blog(Request $request)
    {
        $name = $request->name;
        $lsBlog = Promotion::all();
        $count = 0;
        if ($name != null) {
            $lsPromotion = Promotion::where('promotions.title', 'like', '%' . $name . '%');
            $count = $lsPromotion->count();
            if ($count == 0) {
                $lsPromotion = null;
            } else {
                $lsPromotion = Promotion::where('promotions.title', 'like', '%' . $name . '%')->get();
                $lsTag = Tag::whereIn('tags.id', [8, 9])->get();
            }
        } else {
            $lsPromotion = Promotion::all();
            $lsTag = Tag::whereIn('tags.id', [8, 9])->get();
        }
        return view('blog')->with(['lsPromotion' => $lsPromotion, 'lsTag' => $lsTag, 'name' => $name, 'lsBlog' => $lsBlog]);
    }

    public function blogDetail(Request $request, $id)
    {
        $name = $request->name;
        $blog = Promotion::find($id);
        $lsTag = Tag::all();
        $lsBlog = Promotion::all();
        return view('blogDetail')->with(['blog' => $blog, 'lsTag' => $lsTag, 'lsBlog' => $lsBlog, 'name' => $name]);
    }

    public function contact()
    {
        $lsBlog = Promotion::all();
        return view('contactus')->with(['lsBlog' => $lsBlog]);
    }

    public function checkout()
    {
        $lsBlog = Promotion::all();
        return view('chechout')->with(['lsBlog' => $lsBlog]);
    }

    public function menu(Request $request)
    {
        $name = $request->name;
        $lsBlog = Promotion::all();
        $count = 0;
        if ($name != null) {
            $lsProduct = Product::where('products.name', 'like', '%' . $name . '%');
            $count = $lsProduct->count();
            if ($count == 0) {
                $lsProduct = null;
            } else {
                $lsProduct = Product::where('products.name', 'like', '%' . $name . '%')->get();
                $lsProductLH = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price')->get();
                $lsProductHL = Product::where('products.name', 'like', '%' . $name . '%')->orderBy('price', 'DESC')->get();
                $lsTag = Tag::all();
            }
        } else {
            $lsProduct = Product::all();
            $lsProductLH = Product::orderBy('price')->get();
            $lsProductHL = Product::orderBy('price', 'DESC')->get();
            $lsTag = Tag::all();
        }
        return view('menu')->with(['lsProduct' => $lsProduct, 'lsTag' => $lsTag, 'name' => $name, 'lsProductLH' => $lsProductLH, 'lsProductHL' => $lsProductHL, 'lsBlog' => $lsBlog]);
    }

    public function slideFilter(Request $request)
    {
        $name = $request->name;
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $lsBlog = Promotion::all();

        $lsProduct = Product::whereBetween('products.price', [$min, $max])->paginate(9);
        $lsPr = Product::whereBetween('products.price', [$min, $max])->paginate(9);
        $lsTag = Tag::all();

        return view('menu')->with(['lsProduct' => $lsProduct, 'lsBlog' => $lsBlog, 'lsPr' => $lsPr, 'name' => $name, 'lsTag' => $lsTag]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $lsProduct = Product::all();
        $lsBlog = Promotion::all();
        $lsFb = Feedback::where('feedback.product_id', '=', $id)->orderBy('created_at', 'desc')->paginate(5);
        $lsTag = Tag::all();
        return view('detail')->with(['product' => $product, 'lsProduct' => $lsProduct, 'lsBlog' => $lsBlog, 'lsTag' => $lsTag, 'lsFb' => $lsFb]);
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
        $lsBlog = Promotion::all();
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
        return view('search')->with(['lsProduct' => $lsProduct, 'lsBlog' => $lsBlog, 'search' => $search]);
    }
}
