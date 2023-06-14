<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function categoryPage($id,$slug){
        $category=Category::findOrFail($id);
        $categoryProduct=Product::where('product_category_id',$category->id)->latest()->get();
        $chunks=$categoryProduct->chunk(4);
        return view('home.category',compact('chunks','category'));
    }
    public function singleProduct(){
        return view('home.product');
    }
    public function addToCard(){
        return view('home.addToCard');
    }
    public function checkout(){
        return view('home.checkout');
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
