<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    //1. Properties

    //2. Constructor

    //3. Methods
    public function home()
    {
        // MVC (Business Logic)
        $categories = Category::whereNotNull('rank')->orderBy('rank', 'asc')->get();
        return view('home', ['categories' => $categories]); // home.blade.php
    }
}
