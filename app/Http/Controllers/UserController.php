<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eid = "";
        $ename = "";
        $eun = "";
        $lsUser = User::all();
        return view('admin.dashboard')->with(['lsUser' => $lsUser, 'eid' => $eid, 'ename' => $ename, 'eun' => $eun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request)
    {
      $eid = $request->id;
      $ename = $request->name;
      $eun = $request->username;
      $lsUser = User::all();
      return view('admin.dashboard')->with(['lsUser' => $lsUser, 'eid' => $eid, 'ename' => $ename, 'eun' => $eun]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $request->validate([
          'name' => 'required|string|max:255',
          'password' => 'required|string|min:8|confirmed',
      ]);
      $user = User::find($request->id);
      $user->name = $request->name;
      $user->password = Hash::make($request->password);
      $user->save();
      $request->session()->flash('success', 'Cập nhật thành công');
      return redirect('admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();

      return redirect('admin/dashboard');
    }
}
