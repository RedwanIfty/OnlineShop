<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
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
        return view('home.checkout',compact('cart_items','shipping_address'));
    }
    public function userProfile(){
        return view('home.userprofile');
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
