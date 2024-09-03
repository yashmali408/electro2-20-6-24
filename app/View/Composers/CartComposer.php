<?php
 
namespace App\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
       
    ) {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $cartDatas2 = DB::table('carts')
            ->join('users', 'users.id', '=', 'carts.customer_id')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('users.id', Auth::id()) 
            ->get();

        $cartDatas = [];

        foreach ($cartDatas2 as $index => $item) {
            $cartDatas["cartItem" . ($index + 1)] = [
                'total' => $item->sell_price * $item->qty,
            ];
        }

        //dd($cartDatas);
        $grandTotal = collect($cartDatas)->sum('total');
        $couponCode='';
        $couponValue='';
        $couponType='';
        $discount=0;
        if (session()->has('coupon_code')) {

            
            // Retrieve the session values
            $couponCode = session()->get('coupon_code');
            $couponValue = session()->get('coupon_value');
            $couponType = session()->get('coupon_type');

            // Calculate the discount based on the coupon type
            // Example: If coupon type is 'percentage' or 'fixed'
            if ($couponType == 'percentage') {
                $discount = ($grandTotal * $couponValue) / 100;
            } elseif ($couponType == 'fixed') {
                $discount = $couponValue;
            } else {
                $discount = 0;
            }

            $grandTotal = $grandTotal - $discount;
        }

        $cartCount = Cart::where('customer_id', Auth::id())->count();

        $view->with('cart_info', [
                                    'cart_count' => $cartCount,
                                    'cart_total' =>  $grandTotal,
                                    'discountType' =>  $couponType ,
                                    'discountValue' =>  $discount,
                                ]);
    }
}