<?php

namespace App\Http\Controllers;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Carbon\Carbon;


class ReportController extends Controller
{
    public function day(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      if($stime == null && $etime == null){
        $stime = date('Y-m-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->join('products', 'product_orders.product_id', '=', 'products.id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),Product::raw('sum(products.price * product_orders.quantity) as sprice'))
                          ->groupBy('date','orders.created_at')
                          ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                          ->where('orders.status','=',10)
                          ->get();
      } elseif ($stime != null && $etime == null) {
        // code...
      } elseif ($stime == null && $etime != null) {
        // code...
      } elseif ($stime != null && $etime != null) {
        // code...
      } else{

      }

      return view('admin.report.dayreport')->with(['lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
    public function month(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      if($stime == null && $etime == null){
        $stime = date('Y-m-01 00:00:00');
        $lastday = date('t',strtotime('today'));
        $etime = date('Y-m-'.$lastday.' 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->join('products', 'product_orders.product_id', '=', 'products.id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),'orders.created_at',Order::raw('MONTH(orders.created_at) as month'),Product::raw('sum(products.price * product_orders.quantity) as sprice'))
                          ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                          ->where('orders.status','=',10)
                          ->groupBy('MONTH','orders.created_at')
                          ->get();
      }

      return view('admin.report.monthreport')->with(['lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
}
