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
    public function deliverProduct($id){
//        $orderItem=Order::where()
        $order = Order::where('user_id', $id)->where('status', 'pending')->update([
            'status' => 'delivered'
        ]);

      //  $orderModel = Order::find($order); // Assuming the Order model has a primary key of 'id'
//            activity('update')
//                ->performedOn($id)
//                ->causedBy(auth()->user()->id)
//                ->withProperties('product delivered')
//                ->log(auth()->user()->name. ' product delivered');


        return back()->with('message','Product Delivered Successfully');
    }
    public function completeOrders(){
        $ordersData=Order::where('status','delivered')->latest()->get();
        return view('admin.completedOrders',compact('ordersData'));
    }

}
