<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
     * @param \Illuminate\Http\Request $request
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
            if ($image != null) {
                $name = "";
                $name = $image->getClientOriginalExtension();
                $name = time() . "." . $name;

                $image->move(public_path('upload'), $name);
                $name = "upload/" . $name;
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
        if ($request->images != null) {
            $lsImage = Image::where('product_id', '=', $id)->get();
            foreach ($lsImage as $old_img) {
                Storage::delete($old_img->link);
            }
            $lstbImage = Image::where('product_id', '=', $id);
            $lstbImage->delete();
            foreach ($request->images as $image) {
                $name = "";
                $name = $image->getClientOriginalExtension();
                $name = time() . "." . $name;

                $image->move(public_path('upload'), $name);
                $name = "upload/" . $name;
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
     * @param int $id
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
