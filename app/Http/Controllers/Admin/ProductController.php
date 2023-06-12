<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products=Product::latest()->get();
        return view('admin.allProduct',compact('products'));//compact('categories'));
    }
    public function addProduct(){
        $categories=Category::latest()->get();
        return view('admin.addProduct',compact('categories'));
    }
    public function storeProduct(Request $request){
        //dd($request->all());
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image=$request->file('product_img');
        $img_name=time().'-'.$image->getClientOriginalName();
        $request->product_img->move(public_path('upload'),$img_name);
        $img_url='upload/'.$img_name;

        $catergory_name=Category::where('id',$request->product_category_id)->value('category_name');
        $subcategoy_name=SubCategory::where('id',$request->product_subcategory_id)->value('subcategory_name');

        $product=new Product();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->product_short_des = $request->product_short_des;
        $product->product_long_des = $request->product_long_des;
        $product->product_category_name=$catergory_name;
        $product->product_category_id = $request->product_category_id;
        $product->product_subcategory_name=$subcategoy_name;
        $product->product_subcategory_id = $request->product_subcategory_id;
        $product->product_img = $img_url;
        $product->slug=strtolower(str_replace(' ','-',$request->product_name));
        $product->save();

        Category::where('id',$request->product_category_id)->increment('product_count',1);
        SubCategory::where('id',$request->product_subcategory_id)->increment('product_count',1);
        activity('create')
            ->performedOn($product)
            ->causedBy(auth()->user()->id)
            ->withProperties($product)
            ->log(auth()->user()->name. ' create new product');

        return redirect()->route('allproducts')->with('message','Product added Successfully');
    }
    public function editProductImg($id){
        $productImg=Product::findOrFail($id);
        return view('admin.editProductImg',compact('productImg'));
    }
    public function updateProductImg(Request $request){
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //dd($request->all());
        $image=$request->file('product_img');
        $img_name=time().'-'.$image->getClientOriginalName();
//        return $img_name;
        $request->product_img->move(public_path('upload'),$img_name);
        $img_url='upload/'.$img_name;
        $id=$request->product_id;
        $product=Product::findOrFail($id);
//        return $product;
        $product->product_img=$img_url;
        $product->save();

        activity('update')
            ->performedOn($product)
            ->causedBy(auth()->user()->id)
            ->withProperties($product)
            ->log(auth()->user()->name. ' update product image');

        return redirect()->route('allproducts')->with('message','Update Product Image Successfully');
    }
    public function editProduct($id){
        $product=Product::findOrFail($id);
        return view('admin.editProduct',compact('product'));
    }
    public function updateProduct(Request $request){
        //dd($request->all());
        $id=$request->product_id;
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);
        $product=Product::findOrFail($id);
        $product->product_name=$request->product_name;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->product_short_des=$request->product_short_des;
        $product->product_long_des=$request->product_long_des;
        $product->slug=strtolower(str_replace(' ','-',$request->product_name));
        $product->save();

        activity('update')
            ->performedOn($product)
            ->causedBy(auth()->user()->id)
            ->withProperties($product)
            ->log(auth()->user()->name. ' update product');

        return redirect()->route('allproducts')->with('message','Update Product Successfully');

    }
    public function deleteProduct($id){
        $cat_id=Product::where('id',$id)->value('product_category_id');
        $sub_catId=Product::where('id',$id)->value('product_subcategory_id');
        //return response()->json(['catagory_id'=>$cat_id,'sub_catagory_id'=>$sub_catId]);
        $product=Product::findOrFail($id);
        Category::where('id',$cat_id)->decrement('product_count',1);
        SubCategory::where('id',$sub_catId)->decrement('product_count',1);
        $product->delete();

        activity('delete')
            ->performedOn($product)
            ->causedBy(auth()->user()->id)
            ->withProperties($product)
            ->log(auth()->user()->name. ' delete product');

        return redirect()->route('allproducts')->with('message','Delete Product Successfully');


    }
}
