<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        if($name == null){
          $lsTag = Tag::paginate(8);
        }elseif ($name != null) {
          $lsTag = Tag::where('name', 'like', '%'.$name.'%')
                      ->paginate(8);
        }

        return view('admin.tag.list')->with(['lsTag' => $lsTag, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.tag.add');
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
        'name' => 'required|unique:tags|max:255',
      ]);
      $tag = new Tag();
      $tag->name = $request->name;
      $tag->save();

      $request->session()->flash('success1');
      return redirect('admin/tags');
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
      $tag = Tag::find($id);
      return view('admin.tag.edit')->with('tag', $tag);
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
        'name' => 'required|unique:tags|max:255',
      ]);

      $tag = Tag::find($id);
      $tag->name = $request->name;
      $tag->save();

      $request->session()->flash('success2');
      return redirect('admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
      $tag = Tag::find($id);
      $tag->delete();

      $request->session()->flash('success', 'Xoá thành công');
      return redirect('admin/tags');
    }
}
