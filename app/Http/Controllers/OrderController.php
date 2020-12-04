<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ma = $request->ma;
        if($ma != null){
          $ma = str_replace('DH0000','',$ma);
        }

        $name = $request->name;
        $from = $request->from;
        $to = $request->to;
        $status = $request->status;
        if($ma == null && $name == null && $from == null && $to == null && $status == null){
          $lsOrder = Order::orderBy('created_at', 'DESC')->paginate(10);
        } elseif($ma != null && $name != null && $from != null && $to != null && $status != null){
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma == null && $name != null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from != null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '>', $from)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from == null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '<', $to)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma != null && $name != null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from != null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '>', $from)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from == null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '<', $to)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('status', '=', $status)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma == null && $name != null && $from != null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->paginate(10);
        } elseif ($ma == null && $name != null && $from == null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->paginate(10);
        } elseif ($ma == null && $name != null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from != null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from != null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from == null && $to != null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma != null && $name != null && $from != null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from != null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from == null && $to != null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name != null && $from == null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name != null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('status', '=', $status)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from != null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } elseif ($ma == null && $name != null && $from != null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(10);
        } elseif ($ma == null && $name != null && $from == null && $to != null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name != null && $from != null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from != null && $to != null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('status', '=', $status)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from == null && $to != null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '<', $to)
                          ->paginate(10);
        } elseif ($ma == null && $name == null && $from != null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('created_at', '>', $from)
                          ->paginate(10);
        } elseif ($ma == null && $name != null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->paginate(10);
        } elseif ($ma != null && $name == null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('created_at', 'DESC')
                          ->where('id', '=', $ma)
                          ->paginate(10);
          $ma = 'DH0000'.$ma;
        } else{
          $lsOrder = Order::orderBy('id', 'DESC')->paginate(10);
          $ma = 'DH0000'.$ma;
        }

        return view('admin.order.list')->with(['lsOrder' => $lsOrder, 'ma' => $ma, 'name' => $name, 'from' => $from, 'to' => $to, 'status' => $status]);
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
      $order = Order::find($id);
      return view('admin.order.view')->with(['order'=> $order]);
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

    public function changeStatus(Request $request, $id)
    {
      $order = Order::find($id);
      $order->status = $request->status;
      $order->save();
      $request->session()->flash('success', 'Cập nhật trạng thái thành công');

      return redirect("admin/orders");
    }
}
