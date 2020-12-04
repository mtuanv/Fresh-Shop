<?php

namespace App\Http\Controllers;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;


class ReportController extends Controller
{
    public function day(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      if($stime == null && $etime == null){
        $stime = date('01/m/Y');
        $etime = date('d/m/Y');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->join('products', 'product_orders.product_id', '=', 'products.id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),'orders.created_at',Product::raw('sum(products.price * product_orders.quantity) as sprice'))
                          ->groupBy('created_at')
                          ->get();
      }

      return view('admin.report.dayreport')->with(['lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
    public function month(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      if($stime == null && $etime == null){
        $stime = date('01/Y');
        $etime = date('12/Y');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->join('products', 'product_orders.product_id', '=', 'products.id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),'orders.created_at',Product::raw('sum(products.price * product_orders.quantity) as sprice'))
                          ->groupBy('created_at')
                          ->get();
      }

      return view('admin.report.monthreport')->with(['lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
}
