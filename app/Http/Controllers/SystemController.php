<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show(System $systemInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit(System $systemInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, System $systemInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(System $systemInfo)
    {
        //
    }

    public function login(System $system){
        //I can write all login inside controller
        $app_logo = $system->where('meta_name', 'app_logo')->first()->meta_value;
       
        return view('admin.login',['app_logo'=>'https://icon2.cleanpng.com/20180528/jh/kisspng-arcade-fire-amazon-com-amazon-echo-logo-amazon-5b0bbebde299d5.8644006315274963819282.jpg']);
    }
}