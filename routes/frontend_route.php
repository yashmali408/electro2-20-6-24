<?php


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
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;


use App\Http\Middleware\AdminAuth;



/*   Frontend Routes     */

Route::get('/', [HomeController::class,'home'])->name('homeroute');
// Route for product slugs
Route::get('/{slug}', [HomeController::class, 'show'])->name('home.show');
Route::get('/chat/chat', [ChatController::class, 'chat']);

Route::post('/login',[AuthController::class,'login'])->name('login');

Route::delete('cart/destroy',[CartController::class, 'destroyAll'])->name('cart.destroyAll');
Route::put('cart/update2',[CartController::class, 'update'])->name('cart.update2');


Route::prefix('/shop')->group(function () {
    

    Route::get('/shop-grid',[ProductFilterController::class,'filter'])->name('shop-grid');;
    Route::get('/shop',function(){
        return view('shop/shop'); //shop.blade.php
    });
    Route::resource('wishlist', WishlistController::class);

    Route::get('/single-product-fullwidth',function(){
        return view('shop/single-product-fullwidth'); //shop.blade.php
    });

    Route::resource('cart',CartController::class);

    Route::resource('coupons',CouponController::class);

    Route::post('coupons/apply',[CouponController::class, 'applyCoupon'])->name('coupons.apply');
    
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
    
    Route::resource('/checkout',CheckoutController::class);
    
});
Route::get('/checkout/success',[CheckoutController::class, 'success'])->name('checkout.success');

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


?>