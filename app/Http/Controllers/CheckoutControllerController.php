<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userInfo = UserInfo::where('user_id', 7);
       
        /*  $userInfo = DB::table('user_infos')
                    ->where('user_id', 7); */
        $country = UserInfo::where('user_id', Auth::id())
                    ->where('meta_key', 'country')
                    ->first();
        $street_address = UserInfo::where('user_id', Auth::id())
                    ->where('meta_key', 'street_address')
                    ->first();
        $house_no = UserInfo::where('user_id', Auth::id())
                    ->where('meta_key', 'house_no')
                    ->first();

        
        //
        $cartDatas2 = DB::table('carts')
            ->join('users', 'users.id', '=', 'carts.customer_id')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('users.id', Auth::id())
            ->select(
                'products.id as product_id',
                'products.*', // Select all columns from the products table
                'carts.*' // Select all columns from the carts table
            ) 
            ->get();

        $cartDatas = [];

        foreach ($cartDatas2 as $index => $item) {
            $cartDatas["cartItem" . ($index + 1)] = [
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'unit_price' => $item->sell_price,
                'qty' => $item->qty,
                'total' => $item->sell_price * $item->qty,
            ];
        }

        //dd($cartDatas);
        $grandTotal = collect($cartDatas)->sum('total');

        //echo $grandTotal; // Output: 10200
        //$grandTotal = 10200;


        return view('shop/checkout',[
            'cartDatas'=>$cartDatas,
            'grandTotal'=>$grandTotal,
            'userInfo' => $userInfo,
            'country' => $country->meta_value,
            'house_no' => $house_no->meta_value?$house_no->meta_value:'',
            'street_address'=> $street_address->meta_value?$street_address->meta_value:''
        ]); //checkout.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());

        //Empty the cart if Payment MOD is COD
        if($request->paymentMode == 'COD'){
            
            $cart = Cart::where('customer_id', auth()->user()->id)->delete();
        }
        return redirect('checkout/success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function success(){
        return view('shop.success');
    }
}