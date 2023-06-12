<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::latest()->get();
        return view('admin.allCategory',compact('categories'));
    }
    public function addCategory(){
        return view('admin.addCategory');
    }
    public function storeCategory(Request $request){
        //dd($request->all());
        $request->validate([
           'category_name'=>'required|unique:categories'
        ]);
        $categories=new Category();
        $categories->category_name=$request->category_name;
        $categories->slug=strtolower(str_replace(' ','-',$request->category_name));
        $categories->save();
        activity('create')
            ->performedOn($categories)
            ->causedBy(auth()->user()->id)
            ->withProperties($categories)
            ->log(auth()->user()->name. ' added category');
        return redirect()->route('allcategory')->with('message','Category  Added Successfully!');
    }
    public function editCategory($id){
        $category_info=Category::findOrFail($id);
        return view('admin.editcategory',compact('category_info'));
    }
    public function updateCategory(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories'
        ]);
        $categories=Category::where('id',$request->category_id)->first();
        $categories->category_name=$request->category_name;
        $categories->slug=strtolower(str_replace(' ','-',$request->category_name));
        $categories->save();
        activity('update')
            ->performedOn($categories)
            ->causedBy(auth()->user()->id)
            ->withProperties($categories)
            ->log(auth()->user()->name. ' updates category');
        return redirect()->route('allcategory')->with('message','Category  Updated Successfully!');

    }
    public function deleteCategory($id){
        $category=Category::findOrFail($id);
        if($category->subcategory_count>0){
            return redirect()->route('allcategory')->with('errormessage','Category  can not be deleted!');
        }
        //return $category;
        $category->delete();
        activity('delete')
            ->performedOn($category)
            ->causedBy(auth()->user()->id)
            ->withProperties($category)
            ->log(auth()->user()->name. ' delete category');
        return redirect()->route('allcategory')->with('message','Category  Deleted Successfully!');

    }
}
