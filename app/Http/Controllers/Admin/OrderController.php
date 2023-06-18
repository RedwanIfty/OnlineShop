<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $ordersData = Order::select('user_id', 'product_id', 'shipping_phoneNumber', 'shipping_city', 'shipping_postalcode','quantity','total_price')
            ->where('status','pending')
            ->get();

        return view('admin.pendingOrders',compact('ordersData'));
    }

}
