<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductFilterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SystemInfoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;


use App\Http\Middleware\AdminAuth;

/*   Frontend Routes     */

Route::get('/', [HomeController::class,'home'])->name('homeroute');
// Route for product slugs
Route::get('/{slug}', [HomeController::class, 'show'])->name('home.show');
Route::get('/chat/chat', [ChatController::class, 'chat']);

Route::post('/login',[AuthController::class,'login'])->name('login');


Route::prefix('/shop')->group(function () {
    

    Route::get('/shop-grid',[ProductFilterController::class,'filter'])->name('shop-grid');;
    Route::get('/shop',function(){
        return view('shop/shop'); //shop.blade.php
    });
    Route::resource('wishlist', WishlistController::class);

    Route::get('/single-product-fullwidth',function(){
        return view('shop/single-product-fullwidth'); //shop.blade.php
    });


    Route::get('/cart',function(){
        return view('shop/cart');
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
    Route::get('/', [SystemInfoController::class,'login'])->withoutMiddleware([AdminAuth::class]);
    Route::get('/login', function () {
        // Matches The "/admin/login" URL
        return view('admin.login'); //login.blade.php
    })->withoutMiddleware([AdminAuth::class]);
    
    Route::get('/logout/logout',[AuthController::class,'logout']);
    Route::get('/dashboard', [AuthController::class,'dashboard'])->name('admin_dashboard');
    
    
    Route::resource('products', ProductController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('brands', BrandController::class);
    
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
    Route::get('/logout', [CustomerAuthController::class,'logout']);

    // /shop/review
    Route::resource('review', ReviewController::class);
});