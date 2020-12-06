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
      $sort = $request->sort;
      if($stime == null && $etime == null){
        $stime = date('Y-m-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        if($sort == null){
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
        } elseif ($sort == '1') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($datetotal[$i]->stotal > $datetotal[$j]->stotal){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($datetotal[$i]->stotal < $datetotal[$j]->stotal){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($price[$i]->sprice > $price[$j]->sprice){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($price[$i]->sprice < $price[$j]->sprice){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($discount[$i] > $discount[$j]){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($discount[$i] < $discount[$j]){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } else {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
        }

      } elseif ($stime != null && $etime == null) {
        $stime = date('Y-d-m 00:00:00', strtotime($stime));
        $etime = date('Y-m-d 23:59:59');
        if($sort == null){
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
        } elseif ($sort == '1') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($datetotal[$i]->stotal > $datetotal[$j]->stotal){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '2') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($datetotal[$i]->stotal < $datetotal[$j]->stotal){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '3') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($price[$i]->sprice > $price[$j]->sprice){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '4') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($price[$i]->sprice < $price[$j]->sprice){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '5') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($discount[$i] > $discount[$j]){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } elseif ($sort == '6') {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
          $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
          for($i = 0; $i < count($datetotal) - 1; $i++){
            for($j = $i + 1; $j < count($datetotal); $j++){
              if($discount[$i] < $discount[$j]){
                $tg = $datetotal[$i]->date;
                $datetotal[$i]->date = $datetotal[$j]->date;
                $datetotal[$j]->date = $tg;
                $tg = $datetotal[$i]->stotal;
                $datetotal[$i]->stotal = $datetotal[$j]->stotal;
                $datetotal[$j]->stotal = $tg;
                $tg = $price[$i]->sprice;
                $price[$i]->sprice = $price[$j]->sprice;
                $price[$j]->sprice = $tg;
                $tg = $discount[$i];
                $discount[$i] = $discount[$j];
                $discount[$j] = $tg;
              }
            }
          }
        } else {
          $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->groupBy('date')
                             ->get();

          $id = Order::select('id')
                             ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                             ->where('orders.status','=',10)
                             ->get();
         $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                              ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                              ->whereIn('order_id',$id)
                              ->groupBy('date')
                              ->get();
          for ($i=0; $i < count($datetotal); $i++) {
            $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
          }
        }

      } elseif ($stime == null && $etime != null) {
        $etime = date('Y-d-m 23:59:59', strtotime($etime));
      } elseif ($stime != null && $etime != null) {
        $stime = date('Y-d-m 00:00:00', strtotime($stime));
        $etime = date('Y-d-m 23:59:59', strtotime($etime));
        $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();

        $id = Order::select('id')
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->get();
        $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                            ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                            ->whereIn('order_id',$id)
                            ->groupBy('date')
                            ->get();
        for ($i=0; $i < count($datetotal); $i++) {
          $discount[$i] = $price[$i]->sprice - $datetotal[$i]->stotal;
        }
      } else{
        $stime = date('Y-m-01 00:00:00');
        $etime = date('Y-m-d 23:59:59');
        $datetotal = Order::select(Order::raw('sum(orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'))
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->groupBy('date')
                           ->get();

        $id = Order::select('id')
                           ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                           ->where('orders.status','=',10)
                           ->get();
       $price = ProductOrder::join('products', 'product_orders.product_id', '=', 'products.id')
                            ->select(ProductOrder::raw('sum(products.price * product_orders.quantity) as sprice'),ProductOrder::raw('DATE(product_orders.created_at) as date'))
                            ->whereIn('order_id',$id)
                            ->groupBy('date')
                            ->get();
      }

      return view('admin.report.dayreport')->with(['datetotal' => $datetotal, 'price' => $price, 'discount' => $discount, 'stime' => $stime, 'etime' => $etime]);
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

      return view('admin.report.monthreport')->with(['datetotal' => $datetotal, 'price' => $price, 'stime' => $stime, 'etime' => $etime]);
    }
}
