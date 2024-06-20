<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminAuth;

/*   Frontend Routes     */

Route::get('/', function () {
    return view('home');
})->name('homeroute');

Route::post('/login',[AuthController::class,'login'])->name('login');


Route::prefix('/shop')->group(function () {
    Route::get('/cart',function(){
        return view('shop/cart');
    });
    Route::get('/shop-grid',function(){
        return view('shop/shop-grid'); //shop-grid.blade.php
    });
    Route::get('/my-account',function(){
        return view('shop/my-account'); //my-account.blade.php
    });
    Route::get('/my-account',function(){
        return view('shop/my-account'); //my-account.blade.php
    });
    Route::get('/track-your-order',function(){
        return view('shop/track-your-order'); //my-account.blade.php
    });
    Route::get('/compare',function(){
        return view('shop/compare'); //compare.blade.php
    });
    Route::get('/shop',function(){
        return view('shop/shop'); //shop.blade.php
    });
    Route::get('/checkout',function(){
        return view('shop/checkout'); //checkout.blade.php
    });
});

Route::get('/about',function(){
    return view('about'); //about.blade.php
});
Route::get('/faq',function(){
    return view('faq'); //faq.blade.php
});
Route::get('/store-directory',function(){
    return view('store-directory'); //store-directory.blade.php
});
Route::get('/terms-and-conditions',function(){
    return view('terms-and-conditions'); //terms-and-conditions.blade.php
});
Route::get('/contact-v1',function(){
    return view('contact-v1'); //contact-v1.blade.php
});



/*   Backend/Admin Routes     */

Route::prefix('admin')->middleware(AdminAuth::class)->group(function () { // /admin/login
    Route::get('/', function () {
        // Matches The "/admin/login" URL
        return view('admin.login'); //login.blade.php
    })->withoutMiddleware([AdminAuth::class]);
    Route::get('/login', function () {
        // Matches The "/admin/login" URL
        return view('admin.login'); //login.blade.php
    })->withoutMiddleware([AdminAuth::class]);
    
    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/dashboard', [AuthController::class,'dashboard'])->name('admin_dashboard');
    Route::resource('category', CategoryController::class);
    
    /* Only for practice */
    
    Route::get('/general', function () { // /admin/general
        // Matches The "/admin/login" URL
        return view('admin.general'); //general.blade.php
    });
});

/*   Frontend Routes     */
Route::prefix('customer')->group(function () { // /admin/login
    Route::post('/register', [CustomerAuthController::class,'register'])->name('customerRegister');
    Route::post('/login', [CustomerAuthController::class,'login'])->name('customerLogin');
});
