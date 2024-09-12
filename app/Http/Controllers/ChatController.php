<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
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
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function chat(){
        $chatDatas = [  // Associative array
            [
                "sender"=>'customercare',
                "msg"=>"Can you share your model no",
                "time"=>"2024-09-05 09:50:00"
            ],
            [
                "sender"=>'customer',
                "msg"=>"ACERT509850",
                "time"=>"2024-09-05 09:50:05",
            ]        
        ];
        return view('chat',['chatDatas'=>$chatDatas]); //chat.blade.php
    }

    public function cc_chat(){
        return view('customercare.cc_chat'); //cc_chat.blade.php
    }
}