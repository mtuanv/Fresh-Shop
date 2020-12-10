<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductOrder;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = getdate();
        $order = Order::whereMonth('created_at', $date['mon'])
                      ->select('id')
                      ->count('id');
        $sumsale = ProductOrder::whereMonth('orders.created_at', $date['mon'])
                               ->join('orders', 'orders.id', '=', 'product_orders.order_id')
                               ->where('status', '=', 10)
                               ->select('quantity')
                               ->sum('quantity');
        $corder = Order::whereMonth('created_at', $date['mon'])
                      ->where('status', '=', 10)
                      ->select('id')
                      ->count('id');
        $money = Order::whereMonth('created_at', $date['mon'])
                      ->where('status', '=', 10)
                      ->select('total')
                      ->sum('total');
        $eid = "";
        $ename = "";
        $eun = "";
        $lsUser = User::all();
        return view('admin.dashboard')->with(['lsUser' => $lsUser, 'eid' => $eid, 'ename' => $ename, 'eun' => $eun, 'money' => $money, 'corder' => $corder, 'sumsale' => $sumsale, 'order' => $order]);
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
      $date = getdate();
      $order = Order::whereMonth('created_at', $date['mon'])
                    ->select('id')
                    ->count('id');
      $sumsale = ProductOrder::whereMonth('orders.created_at', $date['mon'])
                             ->join('orders', 'orders.id', '=', 'product_orders.order_id')
                             ->where('status', '=', 10)
                             ->select('quantity')
                             ->sum('quantity');
      $corder = Order::whereMonth('created_at', $date['mon'])
                    ->where('status', '=', 10)
                    ->select('id')
                    ->count('id');
      $money = Order::whereMonth('created_at', $date['mon'])
                    ->where('status', '=', 10)
                    ->select('total')
                    ->sum('total');
      $lsUser = User::all();
      return view('admin.dashboard')->with(['lsUser' => $lsUser, 'eid' => $eid, 'ename' => $ename, 'eun' => $eun, 'money' => $money, 'corder' => $corder, 'sumsale' => $sumsale, 'order' => $order]);
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
          'name' => 'required|string|max:255'
      ]);
      $user = User::find($request->id);
      $user->name = $request->name;
      $path="";
      if($request->avatar != null){
          Storage::delete($user->avatar);
          $name = $request->avatar->getClientOriginalExtension();
          $name = time().".".$name;

          $request->avatar->move(public_path('upload/avatar'), $name);
          $path = "upload/avatar/".$name;
      }
      if($path != null){
        $user->avatar = $path;
      }
      $user->save();
      $request->session()->flash('success', 'Cập nhật thông tin thành công');
      return redirect('admin/dashboard');
    }
    public function changePassword(Request $request)
    {
      $eid = $request->id;
      $ename = $request->name;
      $date = getdate();
      $order = Order::whereMonth('created_at', $date['mon'])
                    ->select('id')
                    ->count('id');
      $sumsale = ProductOrder::whereMonth('orders.created_at', $date['mon'])
                             ->join('orders', 'orders.id', '=', 'product_orders.order_id')
                             ->where('status', '=', 10)
                             ->select('quantity')
                             ->sum('quantity');
      $corder = Order::whereMonth('created_at', $date['mon'])
                    ->where('status', '=', 10)
                    ->select('id')
                    ->count('id');
      $money = Order::whereMonth('created_at', $date['mon'])
                    ->where('status', '=', 10)
                    ->select('total')
                    ->sum('total');
      $lsUser = User::all();
      return view('admin.dashboard')->with(['lsUser' => $lsUser, 'eid' => $eid, 'ename' => $ename, 'money' => $money, 'corder' => $corder, 'sumsale' => $sumsale, 'order' => $order]);
    }
    public function savechangePassword(Request $request)
    {
      $request->validate([
          'password' => 'required|string|min:8|confirmed',
      ]);
      $user = User::find($request->id);
      $user->password = Hash::make($request->password);
      $user->save();
      $request->session()->flash('success', 'Cập nhật mật khẩu thành công');
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
