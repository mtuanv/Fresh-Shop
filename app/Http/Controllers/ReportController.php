<?php

namespace App\Http\Controllers;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
use App\Exports\ReportsExport2;

class ReportController extends Controller
{
    public function day(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      $sort = $request->sort;
      if($stime == null && $etime == null){
        $stime = date('Y-m-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();
        $stime = date('d/m/Y',strtotime($stime));
        $etime = date('d/m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date')
                             ->get();
        } elseif ($sort == '8') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date','DESC')
                             ->get();
        }

      } elseif ($stime != null && $etime == null) {
        $stime = str_replace('/', '-', $stime);
        $stime = strtotime($stime);
        $stime = date('Y-m-d 00:00:00', $stime);
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();
        $stime = date('d/m/Y',strtotime($stime));
        $etime = date('d/m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date')
                             ->get();
        } elseif ($sort == '8') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date','DESC')
                             ->get();
        }

      } elseif ($stime == null && $etime != null) {
        $etime = str_replace('/', '-', $etime);
        $etime = strtotime($etime);
        $etime = date('Y-m-d 23:59:59', $etime);
        $stime = Order::select(Order::raw('orders.created_at'))
                      ->orderBy('created_at','ASC')
                      ->first();
        $stime = substr($stime,15,27);
        $stime = date('Y-m-d 00:00:00', strtotime($stime));
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();
         $stime = date('d/m/Y',strtotime($stime));
         $etime = date('d/m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date')
                             ->get();
        } elseif ($sort == '8') {
          $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                            ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->orderBy('date','DESC')
                             ->get();
        }

      } elseif ($stime != null && $etime != null) {
        $stime = str_replace('/', '-', $stime);
        $stime = strtotime($stime);
        $stime = date('Y-m-d 00:00:00', $stime);
        $etime = str_replace('/', '-', $etime);
        $etime = strtotime($etime);
        $etime = date('Y-m-d 23:59:59', $etime);
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();
       $stime = date('d/m/Y',strtotime($stime));
       $etime = date('d/m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->date > $lsReport[$j]->date)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->date < $lsReport[$j]->date)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      } else{
        $stime = date('Y-m-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();
         $stime = date('d/m/Y',strtotime($stime));
         $etime = date('d/m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->date > $lsReport[$j]->date)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->date < $lsReport[$j]->date)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      }

      return view('admin.report.dayreport')->with(['sort' => $sort, 'lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
    public function month(Request $request){
      $stime = $request->StartTime;
      $etime = $request->EndTime;
      $sort = $request->sort;
      if($stime == null && $etime == null){
        $stime = date('Y-01-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('MONTH(orders.created_at) as month'),Order::raw('YEAR(orders.created_at) as year'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('month','year')
                           ->get();
        $stime = date('m/Y',strtotime($stime));
        $etime = date('m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month > $lsReport[$j]->month && $lsReport[$i]->year >= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month < $lsReport[$j]->month && $lsReport[$i]->year <= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      } elseif ($stime != null && $etime == null) {
        $stime = '01/'.$stime;
        $stime = str_replace('/', '-', $stime);
        $stime = strtotime($stime);
        $stime = date('Y-m-d 00:00:00', $stime);
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('MONTH(orders.created_at) as month'),Order::raw('YEAR(orders.created_at) as year'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('month','year')
                           ->get();
        $stime = date('m/Y',strtotime($stime));
        $etime = date('m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month > $lsReport[$j]->month && $lsReport[$i]->year >= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month < $lsReport[$j]->month && $lsReport[$i]->year <= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      } elseif ($stime == null && $etime != null) {
        $lastday = date('t',strtotime($etime));
        $etime = date('Y-m-'.$lastday.' 23:59:59');
        $stime = Order::select(Order::raw('orders.created_at'))
                      ->orderBy('created_at','ASC')
                      ->first();
        $stime = substr($stime,15,27);
        $stime = date('Y-m-01 00:00:00', strtotime($stime));
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('MONTH(orders.created_at) as month'),Order::raw('YEAR(orders.created_at) as year'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('month','year')
                           ->get();
        $stime = date('m/Y',strtotime($stime));
        $etime = date('m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month > $lsReport[$j]->month && $lsReport[$i]->year >= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month < $lsReport[$j]->month && $lsReport[$i]->year <= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      } elseif ($stime != null && $etime != null) {
        $stime = '01/'.$stime;
        $stime = str_replace('/', '-', $stime);
        $stime = strtotime($stime);
        $stime = date('Y-m-d 00:00:00', $stime);
        $lastday = date('t',strtotime($etime));
        $etime = date('Y-m-'.$lastday.' 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('MONTH(orders.created_at) as month'),Order::raw('YEAR(orders.created_at) as year'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('month','year')
                           ->get();
        $stime = date('m/Y',strtotime($stime));
        $etime = date('m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month > $lsReport[$j]->month && $lsReport[$i]->year >= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month < $lsReport[$j]->month && $lsReport[$i]->year <= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      } else {
        $stime = date('Y-01-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                          ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('MONTH(orders.created_at) as month'),Order::raw('YEAR(orders.created_at) as year'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('month','year')
                           ->get();
        $stime = date('m/Y',strtotime($stime));
        $etime = date('m/Y',strtotime($etime));
        if ($sort == '1') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal > $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->stotal < $lsReport[$j]->stotal){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice > $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if($lsReport[$i]->sprice < $lsReport[$j]->sprice){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) > ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->sprice - $lsReport[$i]->stotal) < ($lsReport[$j]->sprice - $lsReport[$j]->stotal)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '7') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month > $lsReport[$j]->month && $lsReport[$i]->year >= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '8') {
          for($i = 0; $i < count($lsReport) - 1; $i++){
            for($j = $i + 1; $j < count($lsReport); $j++){
              if(($lsReport[$i]->month < $lsReport[$j]->month && $lsReport[$i]->year <= $lsReport[$j]->year)){
                $tg = $lsReport[$i];
                $lsReport[$i] = $lsReport[$j];
                $lsReport[$j] = $tg;
              }
            }
          }
        }
      }

      return view('admin.report.monthreport')->with(['sort' => $sort, 'lsReport' => $lsReport, 'stime' => $stime, 'etime' => $etime]);
    }
    public function exportday(Request $request){
      return (new ReportsExport)->from($request->fromt)->to($request->tot)->download('report_day.xlsx');
    }
    public function exportmonth(Request $request){
      return (new ReportsExport2)->from($request->fromt)->to($request->tot)->download('report_month.xlsx');
    }
}
