<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lsProduct = Product::paginate(5);
        return view('admin.product.list')->with(['lsProduct' => $lsProduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $lsTag = Tag::all();
      return view('admin.product.add')->with(['lsTag' => $lsTag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required|unique:products|max:255',
        'price' => 'required',
        'quantity' => 'required',
        'description' => 'required',
        'status' => 'required',
        'tags' => 'required',
        'images' => 'required'
      ]);

      $product = new Product();
      $product->name = $request->name;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->description = $request->description;
      $product->status = $request->status;

      $product->save();
      //Luu Image
      foreach ($request->images as $image) {
        if($image != null){
          $name = "";
          $name = $image->getClientOriginalExtension();
          $name = time().".".$name;

          $image->move(public_path('upload'), $name);
          $name = "upload/".$name;
          $imagee = new Image();
          $imagee->link = $name;
          $imagee->product_id = $product->id;
          $imagee->save();
        }
      }

      //luu ProductControllerTag
      foreach ($request->tags as $tagid) {
        $productTag = new ProductTag();
        $productTag->product_id = $product->id;
        $productTag->tag_id = $tagid;
        $productTag->save();
      }


      $request->session()->flash('success', 'Thêm mới thành công');
      return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
