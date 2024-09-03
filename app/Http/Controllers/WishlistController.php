<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $wishlists = DB::table('wishlists')
        ->join('users', 'users.id', '=', 'wishlists.customer_id')
        ->join('products', 'products.id', '=', 'wishlists.product_id')
        ->where('users.id', Auth::id()) // Correct table name
        ->get();
        
        return view('shop/wishlist',['wishlists'=>$wishlists]);
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
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['status' => 'not_logged_in'], 401);
        }

        $data = $request->only('product_id');
        $data['customer_id'] = Auth::id();

        // Check if the product is already in the wishlist for this user
        $exists = Wishlist::where('customer_id', $data['customer_id'])
                        ->where('product_id', $data['product_id'])
                        ->exists();

        if ($exists) {
            // Return a response indicating the item is already in the wishlist
            return response()->json(['status' => 'exists', 'message' => 'Product is already in your wishlist!'], 200);
        } else {
            // Create the new wishlist entry
            Wishlist::create($data);
            return response()->json(['status' => 'success', 'message' => 'Product added to wishlist successfully!'], 200);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}