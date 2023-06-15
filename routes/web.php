<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\ActivityLogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::redirect('/', 'admin/dashboard');
//Route::get('/',function (){
//    return view('home.layouts.home');
//});
Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('homePage');
});
Route::controller(ClientController::class)->group(function (){
    Route::get('/category/{id}/{slug}','categoryPage')->name('category');
    Route::get('/single-product/{id}/{slug}','singleProduct')->name('singleProduct');
    Route::get('/add-to-card','addToCard')->name('addToCard');
    Route::get('/checkout','checkout')->name('checkout');
    Route::get('/user-profile','userProfile')->name('userProfile');
    Route::get('/new-release','newRelease')->name('newRelease');
    Route::get('/todays-deal','todaysDeal')->name('todaysDeal');
    Route::get('/customer-service','customerService')->name('customerService');

});
Route::get('/user/dashboard',function (){
   return view('user.dashboard');
})->name('user.dashboard')->middleware(['auth','role:user']);
Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
Route::middleware(['auth','role:admin'])->group(function (){
   Route::controller(DashboardController::class)->group(function (){
      Route::get('admin/dashboard',"index")->name('admin.dashboard');
   });
    Route::controller(CategoryController::class)->group(function (){
        Route::get('admin/all-category',"index")->name('allcategory');
        Route::get('admin/add-category',"addCategory")->name('addcategory');
        Route::post('admin/store-category',"storeCategory")->name('storecategory');
        Route::get('admin/edit-category/{id}',"editCategory")->name('editcategory');
        Route::post('admin/update-category/{id}',"updateCategory")->name('updatecategory');
        Route::get('admin/detete-category/{id}',"deleteCategory")->name('deletecategory');

    });
    Route::controller(SubCategoryController::class)->group(function (){
        Route::get('admin/all-sub-category',"index")->name('allsubcategory');
        Route::get('admin/add-sub-category',"addSubCategory")->name('addsubcategory');
        Route::post('admin/store-sub-category',"storeSubcategory")->name('storesubcategory');
        Route::get('admin/edit-sub-category/{id}','editSubcategory')->name('editsubcategory');
        Route::post('admin/update-sub-category/{id}','updateSubCategory')->name('updatesubcategory');
        Route::get('admin/delete-sub-category/{id}','deleteSubcategory')->name('deletesubcategory');
        Route::post('admin/load-sub-categories','loadSubcategories')->name('subcategoryload');

    });
    Route::controller(ProductController::class)->group(function (){
        Route::get('admin/all-products',"index")->name('allproducts');
        Route::get('admin/add-product',"addProduct")->name('addproduct');
        Route::post('admin/store-product','storeProduct')->name('storeproduct');
        Route::get('admin/edit-product-img/{id}/{name}','editProductImg')->name('editimg');
        Route::post('admin/update-product-img','updateProductImg')->name('updateproductimg');
        Route::get('admin/edit-product/{id}','editProduct')->name('editproduct');
        Route::post('admin/update-product','updateProduct')->name('updateproduct');
        Route::get('admin/delete-product/{id}','deleteProduct')->name('deleteproduct');

    });
    Route::controller(OrderController::class)->group(function (){
        Route::get('admin/pending-orders',"index")->name('pendingorders');

    });
    Route::controller(ActivityLogController::class)->group(function (){
       Route::get('admin/activity-log','activityLog')->name('activityLog');
    });
});
//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
