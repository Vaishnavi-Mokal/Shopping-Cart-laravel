<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_image;

class OrderController extends Controller
{
    public function Orders(){
        $orders = Order::all();
        $userdetails = UserDetails::all();
        $orderdetails = OrderDetails::all();
        
        return view('admin.Order.vieworder',compact('orders','userdetails','orderdetails'));
    }

    public function OrdersDetail($id){
        $userdetails = UserDetails::where('id',$id)->first();
        $orderdetails = OrderDetails::where('userdetail_id',$id)->first();
        $orders = Order::where('userdetail_id',$id)->get();
        $product = Product::all();
        $productimages = Product_image::all();
        return view('admin.Order.orderdetail',compact('userdetails','orderdetails','orders','product','productimages'));
    }
}
