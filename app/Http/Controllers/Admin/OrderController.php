<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function index(){
    
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.order.index',['orders' => $orders]);
    }

    public function detail($id){
    
        $order = Order::find($id);
        return view('admin.order.detail',['order' => $order]);
    }
}
