<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $allProducts=Product::orderBy('product_category_name')->get();
        $chunks = $allProducts->chunk(3);
        return view('home.home',compact('allProducts','chunks'));
    }

}
