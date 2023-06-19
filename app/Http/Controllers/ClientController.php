<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function categoryPage($id,$slug){
        $category=Category::findOrFail($id);
        $categoryProduct=Product::where('product_category_id',$category->id)->latest()->get();
        $chunks=$categoryProduct->chunk(4);
        return view('home.category',compact('chunks','category'));
    }
    public function singleProduct($id,$slug){
        $product=Product::findOrFail($id);
        $subCategoryProducts=Product::where('id',$id)->value('product_subcategory_id');
        $subCatProducts=Product::where('product_subcategory_id',$subCategoryProducts)->get();
        $chunks=$subCatProducts->chunk(4);
        return view('home.product',compact('product','chunks'));
    }
    public function addToCard(){
        $user_id=auth()->user()->id;
        $cart_items = Cart::leftJoin('products','carts.product_id','products.id')
            ->select('carts.id','products.product_name','products.product_img','carts.quantity','carts.price')
            ->where('carts.user_id',$user_id)
            ->orderByDesc('carts.created_at','asc')
            ->get();
//        return $cart_item;
        return view('home.addToCard',compact('cart_items'));
    }
    public function addProductToCard($id,Request $request){
        $product_price=$request->price;
        $product_quantity=$request->quantity;
        $price=$product_price * $product_quantity;
        $cart=new Cart();
        $cart->product_id=$request->product_id;
        $cart->user_id=auth()->user()->id;
        $cart->quantity=$product_quantity;
        $cart->price=$price;
        //var_dump($request->all());
        $cart->save();

        return redirect()->route('addToCard')->with('message','Iteam added to cart successfully');
    }
    public function removeCartItem($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('addToCard')->with('message','Iteam remove from cart successfully');
    }
    public function getShippingAddress(){
        return view('home.shippingaddress');
    }
    public function addShippingAddress(Request $request){
        $request->validate([
            'phone_number' => 'required|numeric',
            'city_name' => 'required|string',
            'postal_code' => 'required|string',
        ]);
        $shippingInfo=new ShippingInfo();
        $shippingInfo->user_id=auth()->user()->id;
        $shippingInfo->phone_number=$request->phone_number;
        $shippingInfo->city_name=$request->city_name;
        $shippingInfo->postal_code=$request->postal_code;

        $shippingInfo->save();

        return redirect()->route('checkout');

    }
    public function checkout(){
        $userId=auth()->user()->id;
        $cart_items=Cart::leftJoin('products','carts.product_id','products.id')
            ->select('carts.id','products.product_name','products.product_img','carts.quantity','carts.price')
            ->where('carts.user_id',$userId)
            ->orderByDesc('carts.created_at','asc')
            ->get();
        $shipping_address=ShippingInfo::where('user_id',$userId)->first();

        if (!$shipping_address) {
            return back();//->with('error', 'Shipping information not found.');
        }
        return view('home.checkout',compact('cart_items','shipping_address'));
    }
    public function placeOrder()
    {
        $userId = auth()->user()->id;
        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
        $cart_items = Cart::where('user_id', $userId)->get();

        foreach ($cart_items as $item) {
            $product = Product::find($item->product_id); // Retrieve the product
            if ($product) {
                // Calculate the new quantity
                $newQuantity = $product->quantity - $item->quantity;
                if ($newQuantity < 0) {
                    // Handle case where the quantity goes below zero (out of stock)
                    return redirect()->back()->with('error', 'Product is out of stock');
                }

                // Update the product quantity
                $product->quantity = $newQuantity;
                $product->save();

                // Create the order
                $order = new Order();
                $order->user_id = $userId;
                $order->shipping_phoneNumber = $shipping_address->phone_number;
                $order->shipping_city = $shipping_address->city_name;
                $order->shipping_postalcode = $shipping_address->postal_code;
                $order->product_id = $item->product_id;
                $order->quantity = $item->quantity;
                $order->total_price = $item->price;
                $order->save();

                // Delete the item from the cart
                $item->delete();
            }
        }

        // Delete the shipping information
        ShippingInfo::where('user_id', $userId)->delete();

        return redirect()->route('userPendingOrders')->with('message', 'Your orders have been placed successfully');
    }
    public function cancelOrder(){
        $userId = auth()->user()->id;
        $shipping_address = ShippingInfo::where('user_id', $userId)->first();
        $cart_items = Cart::where('user_id', $userId)->get();

        foreach ($cart_items as $item) {

                // Create the order
                $order = new Order();
                $order->user_id = $userId;
                $order->shipping_phoneNumber = $shipping_address->phone_number;
                $order->shipping_city = $shipping_address->city_name;
                $order->shipping_postalcode = $shipping_address->postal_code;
                $order->product_id = $item->product_id;
                $order->quantity = $item->quantity;
                $order->total_price = $item->price;
                $order->status="cancel";
                $order->save();

                // Delete the item from the cart
                $item->delete();
        }

        // Delete the shipping information
        ShippingInfo::where('user_id', $userId)->delete();

        return redirect()->route('userPendingOrders')->with('message', 'Your orders have been cancel successfully');

    }
    public function pendingOrders(){
        $pendingOrders=Order::where('status','pending')->where('user_id',auth()->user()->id)->latest()->get();
        return view('home.pendingOrders',compact('pendingOrders'));
    }
    public function userProfile(){
        $completedOrders=Order::where('user_id',auth()->user()->id)
            ->where('status','delivered')->latest()->get();
        return view('home.userprofile',compact('completedOrders'));
    }
    public function history(){
        $orders=Order::where('user_id',auth()->user()->id)->latest()->get();
        return view('home.history',compact('orders'));
    }
    public function newRelease(){
        return view('home.newRelease');
    }
    public function todaysDeal(){
        return view('home.todaysDeal');
    }
    public function customerService(){
        return view('home.customerService');
    }
}
