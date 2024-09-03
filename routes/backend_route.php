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


/*   Backend/Admin Routes     */

Route::prefix('admin')->middleware(AdminAuth::class)->group(function () { // /admin/login
    //Route::get('/', [SystemInfoController::class,'login'])->withoutMiddleware([AdminAuth::class]);
    Route::get('/login', [SystemInfoController::class,'login'])->withoutMiddleware([AdminAuth::class]);
    
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

Route::prefix('customercare')->middleware(AdminAuth::class)->group(function () { // /admin/login
    Route::get('/dashboard', [AuthController::class,'cc_dashboard'])->name('customercare_dashboard');
});

/*   Frontend Routes     */
Route::prefix('customer')->group(function () { // /admin/login
    Route::post('/register', [CustomerAuthController::class,'register'])->name('customerRegister');
    Route::post('/login', [CustomerAuthController::class,'login'])->name('customerLogin');
    Route::get('/logout', [CustomerAuthController::class,'logout']);

    // /shop/review
    Route::resource('review', ReviewController::class);
});



?>