<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\PromotionTag;
use Illuminate\Http\Request;
use App\Models\Tag;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lsPromotion = Promotion::paginate(5);
        return view('admin.promotion.list')->with(['lsPromotion' => $lsPromotion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lsTag = Tag::all();
        return view('admin.promotion.add')->with(['lsTag' => $lsTag]);
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
            'title' => 'required|unique:promotions|max:255',
            'cover' => 'required',
            'content' => 'required',
            'status' => 'required',
            'StartTime' => 'required',
            'EndTime' => 'required'
        ]);

        $promotion = new Promotion();
        $promotion->title = $request->title;
        $promotion->cover = $request->cover;
        $promotion->content = $request->content;
        $promotion->status = $request->status;
        $promotion->StartTime = $request->StartTime;
        $promotion->EndTime = $request->EndTime;

        $promotion->save();
        //Luu Image

        $path = " ";
        if ($request->cover != null) {
            $name = $request->cover->getClientOriginalExtension();
            $name = time() . "." . $name;
            $request->cover->move(public_path('upload'), $name);
            $path = "upload/" . $name;
        }
        $promotion->cover = $path;
        $promotion->save();

        //luu PromotionTag
        foreach ($request->tags as $tagid) {
            $promotionTag = new PromotionTag();
            $promotionTag->promotion_id = $promotion->id;
            $promotionTag->tag_id = $tagid;
            $promotionTag->save();
        }


        $request->session()->flash('success', 'Thêm mới thành công');
        return redirect('admin/promotions');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::find($id);
        return view('admin.promotion.view')->with(['promotion' => $promotion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        $lsTag = Tag::all();
        return view('admin.promotion.edit')->with(['promotion' => $promotion, 'lsTag' => $lsTag]);
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
        $promotion = Promotion::find($id);
        $promotion->title = $request->title;
        $promotion->content = $request->content;
        $promotion->StartTime = $request->StartTime;
        $promotion->EndTime = $request->EndTime;

        $path = " ";
        if ($request->cover != null) {
            $name = $request->cover->getClientOriginalExtension();
            $name = time() . "." . $name;
            $request->cover->move(public_path('upload'), $name);
            $path = "upload/" . $name;
            $promotion->cover = $path;
        }

//luu PromotionTag moi
        foreach ($request->tags as $tagid) {
            $promotionTag = new PromotionTag();
            $promotionTag->promotion_id = $promotion->id;
            $promotionTag->tag_id = $tagid;
            $promotionTag->save();
        }
        $promotion->save();
        $request->session()->flash('success', 'Cập nhật thành công');

        return redirect("admin/promotions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();

        $request->session()->flash('success', 'Xoá thành công');
        return redirect('admin/promotions');
    }
}
