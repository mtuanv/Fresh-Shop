<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use DateTime;
use Auth;

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
          $lsOrder = Order::orderBy('id', 'DESC')->paginate(20);
        } elseif($ma != null && $name != null && $from != null && $to != null && $status != null){
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
        } elseif ($ma == null && $name != null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->paginate(20);
        } elseif ($ma == null && $name == null && $from != null && $to == null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('created_at', '>=', $from)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name == null && $from == null && $to != null && $status == null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                        ->orderBy('created_at','ASC')
                        ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('created_at', '<', $to)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name == null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('status', '=', $status)
                          ->paginate(20);
        } elseif ($ma != null && $name != null && $from == null && $to == null && $status == null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from != null && $to == null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '>', $from)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
	        $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from == null && $to != null && $status == null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '<', $to)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
        } elseif ($ma == null && $name != null && $from != null && $to == null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from == null && $to != null && $status == null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('status', '=', $status)
                          ->paginate(20);
        } elseif ($ma == null && $name == null && $from != null && $to != null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name == null && $from != null && $to == null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name == null && $from == null && $to != null && $status != null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name != null && $from != null && $to == null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from != null && $to != null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from == null && $to != null && $status != null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name != null && $from == null && $to != null && $status == null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name != null && $from == null && $to == null && $status != null) {
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name == null && $from != null && $to == null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from != null && $to != null && $status == null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from == null && $to != null && $status != null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from != null && $to == null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name == null && $from != null && $to != null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name != null && $from != null && $to != null && $status == null) {///fuck
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name != null && $from != null && $to == null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = date('Y-m-d 23:59:59');
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '>', $from)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
          $ma = 'DH0000'.$ma;
        } elseif ($ma != null && $name != null && $from == null && $to != null && $status != null) {
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $from = Order::select(Order::raw('orders.created_at'))
                       ->orderBy('created_at','ASC')
                       ->first();
          $from = substr($from,15,27);
          $from = date('Y-m-d 00:00:00', strtotime($from));
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->where('name', 'like', '%'.$name.'%')
                          ->where('created_at', '<', $to)
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma != null && $name == null && $from != null && $to != null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('id', '=', $ma)
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(20);
          $ma = 'DH0000'.$ma;
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } elseif ($ma == null && $name != null && $from != null && $to != null && $status != null) {
          $from = str_replace('/', '-', $from);
          $from = strtotime($from);
          $from = date('Y-m-d 00:00:00', $from);
          $to = str_replace('/', '-', $to);
          $to = strtotime($to);
          $to = date('Y-m-d 23:59:59', $to);
          $lsOrder = Order::orderBy('id', 'DESC')
                          ->where('name', 'like', '%'.$name.'%')
                          ->whereBetween('created_at', [$from, $to])
                          ->where('status', '=', $status)
                          ->paginate(20);
          $from = date('d/m/Y',strtotime($from));
          $to = date('d/m/Y',strtotime($to));
        } else{
          $lsOrder = Order::orderBy('id', 'DESC')->paginate(20);
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
      $request->validate([
        'fname' => 'required',
        'lname' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'total' => 'required'
      ]);

      $order = new Order();
      $order->name = $request->fname.' '.$request->lname;
      $order->phone = $request->phone;
      $order->address = $request->address;
      $order->note = $request->note;
      $order->total = $request->total;
      $order->save();

      $pid = $request->productid;
      $pp = $request->productprice;
      $pq = $request->productqtt;
      for ($i = 1; $i <= count($pid); $i++) {
        $productOrder = new ProductOrder();
        $productOrder->order_id = $order->id;
        $productOrder->product_id = $pid[$i];
        $productOrder->price = $pp[$i];
        $productOrder->quantity = $pq[$i];
        $productOrder->save();
      }
      $request->session()->forget('Cart');
      $request->session()->flash('success', 'Đặt hàng thành công');
      return redirect('menu#success');
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
      $order->user_id = Auth::user()->id;
      $order->save();
      $request->session()->flash('success', 'Cập nhật trạng thái thành công');

      return redirect()->back();
    }
}
