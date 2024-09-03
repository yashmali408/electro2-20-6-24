<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return view('shop/cart',[
                                'cartDatas'=>$cartDatas,
                                'cartDatas2'=>$cartDatas2,
                                'grandTotal'=>$grandTotal
                                ]);
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

        //dd($request->all());

        $data = $request->only('product_id','qty');
        $data['customer_id'] = Auth::id();

         // Check if the product is already in the cart for the current customer
        $existingCart = Cart::where('customer_id', $data['customer_id'])
                            ->where('product_id', $data['product_id'])
                            ->first();

        if ($existingCart) {
            // If the product already exists, update the quantity
            $existingCart->qty += $data['qty'];
            $existingCart->save();
        } else {
            // If the product does not exist in the cart, create a new entry
            Cart::create($data);
        }
        // Redirect back with a success message
        return back()->with('success', 'Product added to Cart successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //var_dump($cart->id);
        //dd('Cart Destroy');
         // Delete the cart item
        $cart->delete();

        // Return back to the same page with a success message (optional)
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
    public function showCart()
    {
        $cartData = Cart::with('product')->get(); // Fetch related product data

        
        return view('shop/cart', ['cartData' => $cartData]);
    }
    public function destroyAll(Request $request)
    {
        //dd('Cart DestroyAll');
         // Get the currently authenticated user's ID
        $customerId = Auth::id();

        // Delete all cart items for the authenticated user
        Cart::where('customer_id', $customerId)->delete();

        // Return back to the same page with a success message (optional)
        return redirect()->back()->with('success', 'Cart Emptied Succesffull');
    }
}