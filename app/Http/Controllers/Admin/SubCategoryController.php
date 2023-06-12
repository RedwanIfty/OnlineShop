<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $subCategories=SubCategory::latest()->get();
        return view('admin.allSubCategory',compact('subCategories'));
    }
    public function addSubCategory(){
        $categories=Category::latest()->get();

        return view('admin.addSubCategory',compact('categories'));
    }
    public function storeSubcategory(Request $request){
        $request->validate([
           'subcategory_name' =>'required|unique:sub_categories',
           'category_id'=>'required'
        ]);
        $category_id=$request->category_id;
        $category_name=Category::where('id',$category_id)->value('category_name');
     //   dd($category_name);
        $subCategory=new SubCategory();
        $subCategory->subcategory_name=$request->subcategory_name;
        $subCategory->category_id=$request->category_id;
        $subCategory->category_name=$category_name;
        $subCategory->slug=strtolower(str_replace(' ','-',$request->subcategory_name));
        $subCategory->save();

        Category::where('id',$category_id)->increment('subcategory_count',1);
        activity('create')
            ->performedOn($subCategory)
            ->causedBy(auth()->user()->id)
            ->withProperties($subCategory)
            ->log(auth()->user()->name. ' create new subcategory');

        return redirect()->route('allsubcategory')->with('message','Subcategory Added Successfully');
    }
    public function editSubcategory($id){
        $subCategory=SubCategory::findOrFail($id);
        $categories=Category::latest()->get();
        return view('admin.editSubcategory',compact('subCategory','categories'));
    }
    public function updateSubCategory(Request $request,$id){
        $request->validate([
            'subcategory_name' =>'required|unique:sub_categories',
            'category_id'=>'required'
        ]);
        $subCategory=SubCategory::findOrFail($id);
        $subCategory->subcategory_name=$request->subcategory_name;
        $subCategory->save();

        activity('update')
            ->performedOn($subCategory)
            ->causedBy(auth()->user()->id)
            ->withProperties($subCategory)
            ->log(auth()->user()->name. ' update subcategory');

        return redirect()->route('allsubcategory')->with('message','Subcategory Updated Successfully');

    }
    public function deleteSubcategory($id){
        $cat_id=SubCategory::where('id',$id)->value('category_id');
        $subCategory=SubCategory::where('id',$id)->first();
        if ($subCategory->product_count>0){
            return redirect()->route('allsubcategory')->with('errormessage','Category  Deleted Successfully!');
        }
        Category::where('id',$cat_id)->decrement('subcategory_count',1);
        $subCategory->delete();
        activity('delete')
            ->performedOn($subCategory)
            ->causedBy(auth()->user()->id)
            ->withProperties($subCategory)
            ->log(auth()->user()->name. ' delete sub category');
        return redirect()->route('allsubcategory')->with('message','Sub Category  Deleted Successfully!');

    }
    public function loadSubcategories(Request $request){
        $subCategoryies=SubCategory::where('category_id',$request->id)->get();
        $html = '';
        $html .= '<option value="">Select Sub Category</option>';

        foreach ($subCategoryies as $subCategory) {
            $html .= '<option value="'.$subCategory->id.'">'.$subCategory->subcategory_name.'</option>';
        }
        return $html;
    }
}
