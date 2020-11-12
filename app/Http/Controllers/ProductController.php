<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $status = $request->status;
        $tags = $request->lstag;
        $sort = $request->sort;
        $lsRequest = [
          'name' => $name,
          'email' => $price,
          'subject' => $status,
          'tags' => $tags,
          'sort' => $sort,
        ];
        $lsTag = Tag::all();
        $lsProduct = Product::join('product_tags', 'products.id', '=', 'product_tags.product_id')
                            ->join('tags', 'product_tags.tag_id', '=', 'tags.id')
                            ->select('products.*')
                            ->where('products.name', 'like', '%'.$name.'%')
                            ->where('products.price', '=', $price)
                            ->where('products.status', '=', $status)
                            ->whereIn('tags.id', $tags)
                            ->distinct()
                            ->paginate(5);
        if($sort == "-" || $sort == null){
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::paginate(5);
          }elseif ($name != null && $price != null && ($status != null && $status != "-") && $tags != null) {
            // $lsProduct = Product::where('products.name', 'like', '%'.$name.'%')
            //                     ->where('products.price', '=', $price)
            //                     ->where('products.status', '=', $status)
            //                     ->join('product_tags', 'products.id', '=', 'product_tags.product_id')
            //                     ->join('tags', 'product_tags.tag_id', '=', 'tags.id')
            //                     ->whereIn('tags.id', $tags)
            //                     ->paginate(5);
          }
        } elseif($sort == "0"){
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('price')->paginate(5);
          }
        } elseif ($sort == "1") {
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('price', 'DESC')->paginate(5);
          }
        } elseif ($sort == "2") {
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('name')->paginate(5);
          }
        } elseif ($sort == "3") {
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('name', 'DESC')->paginate(5);
          }
        } elseif ($sort == "4") {
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('quantity')->paginate(5);
          }
        } elseif ($sort == "5") {
          if($name == null && $price == null && ($status == null || $status == "-") && $tags == null){
            $lsProduct = Product::orderBy('quantity', 'DESC')->paginate(5);
          }
        }

        return view('admin.product.list')->with(['lsProduct' => $lsProduct, 'lsTag' => $lsTag, 'lsRequest' => $lsRequest]);
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
      $product = Product::find($id);
      $lsTag = Tag::all();
      $lsProductTag = ProductTag::all();
      return view('admin.product.edit')->with(['lsTag' => $lsTag, 'product' => $product, 'lsProductTag' => $lsProductTag]);
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
      $request->validate([
        'name' => 'required|max:255',
        'price' => 'required',
        'quantity' => 'required',
        'description' => 'required',
        'status' => 'required',
        'tags' => 'required'
      ]);

      $product = Product::find($id);
      $product->name = $request->name;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->description = $request->description;
      $product->status = $request->status;
      $product->save();
      //Xoa va Luu Image moi neu co request
      if($request->images != null){
        $lsImage = Image::where('product_id', '=', $id)->get();
        foreach ($lsImage as $old_img) {
          Storage::delete($old_img->link);
        }
        $lstbImage = Image::where('product_id', '=', $id);
        $lstbImage->delete();
        foreach ($request->images as $image) {
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

      //Xoa va luu ProductTag moi
      $lsProductTag = ProductTag::where('product_id', '=', $id);
      $lsProductTag->delete();
      foreach ($request->tags as $tagid) {
        $productTag = new ProductTag();
        $productTag->product_id = $product->id;
        $productTag->tag_id = $tagid;
        $productTag->save();
      }


      $request->session()->flash('success', 'Cập nhật thành công');
      return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
      $product = Product::find($id);
      $product->delete();

      $request->session()->flash('success', 'Xoá thành công');
      return redirect('admin/products');
    }
}
