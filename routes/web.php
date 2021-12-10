<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('backend.invoice');
// });
Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('users_view');
Route::get('/user/login',[App\Http\Controllers\FrontendController::class,'login'])->name('login.form');
Route::post('/user/login',[App\Http\Controllers\FrontendController::class,'loginSubmit'])->name('login.submit');
Route::get('user/logout',[App\Http\Controllers\FrontendController::class,'logout'])->name('user.logout');
Route::get('user/register',[App\Http\Controllers\FrontendController::class,'register'])->name('register.form');
Route::post('user/register',[App\Http\Controllers\FrontendController::class,'registerSubmit'])->name('register.submit');
Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index']);



Auth::routes();


Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [App\Http\Controllers\HomeController::class, 'profile_update'])->name('profile-update');
    Route::resource('banner', BannerController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::post('/category/{id}/child',[CategoryController::class,'getChildByParent']);
    Route::resource('postcategory', PostCategoryController::class);
    Route::resource('posttag', PostTagController::class);
    Route::resource('post', PostController::class);
    Route::resource('shipping', ShippingController::class);
    Route::resource('order', OrderController::class);
    Route::resource('coupon', CouponsController::class);
    Route::resource('message', MessageController::class);
    Route::get('invoice', [OrderController::class,'invoice_view'])->name('invoice_view');
    Route::get('/edit-status/{id}', [OrderController::class,'edit']);
    Route::put('modal-update', [OrderController::class,'update'])->name('modal_update');
    Route::get('/employees', [EmployeeController::class,'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class,'store'])->name('employees.store');
    Route::get('employee-edit/{id}', [EmployeeController::class,'edit'])->name('employees.edit');
    Route::put('employee-update', [EmployeeController::class,'update'])->name('employees.update');
    //
    //cart sections



    //payment methods

    // Route::post('/pay', [PaymentController::class,'pay'])->name('pay');

    // Route::post('/indipay/response/success', [PaymentController::class,'response'])->name('pay.response');
    // Route::post('/indipay/response/failure', [PaymentController::class,'response'])->name('pay.response');


    // Route::get('payment-success', [PaymentController::class,'paymentSuccess'])->name("success.pay");
});

Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    // Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('users_view');
    Route::get('/',[App\Http\Controllers\UsersController::class, 'index'])->name('user');
    Route::get('/profile',[App\Http\Controllers\UsersController::class, 'profile'])->name('user_profile');
    Route::get('/getState/{id}',[App\Http\Controllers\UsersController::class, 'getState']);
    Route::post('/profile', [App\Http\Controllers\UsersController::class, 'profile_update'])->name('user-profile-update');
    Route::get('/myorder',[App\Http\Controllers\UsersController::class, 'my_order'])->name('my-order');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('/add-to-cart/{product}', [CartController::class,'addToCart'])->name('add-cart');
    Route::get('/remove/{id}', [CartController::class,'removeFromCart'])->name('remove');
    Route::get('/change-qty/{product}', [CartController::class,'changeQty'])->name('change_qty');
    // Route::get('/country',[App\Http\Controllers\UsersController::class, 'country']);

});
