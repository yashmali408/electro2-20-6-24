<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\AdminBaseController;

use Illuminate\Http\Request;

//Class ChildClass extends ParentClass{}
// Single Inheritance
// THis is an example of single inheritance
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.category.index');
        // admin/category/index.blade.php
        
        //return 'index';
    }

    /**
     * Show the form for creating a new resource.
     * Show the form for creating a new category.
     */
    public function create()
    {
        //
        return view('admin.category.create'); //create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $request->validate([
                            'category_name'=>'required|unique:categories',
                            'description'=>'',
                            'cat_image' => 'mimes:jpg,jpeg,png|max:1024',// 1024kb = 1mb
                          ]); //PHP Associative Array
        
        //dd($request->file('cat_image'));
        $file = $request->file('cat_image');
        $dst='';                  
        if($file){
            
            $path = $file->store('public/cat_images');
            //The file is comming
             // Extract the filename from the path
            $filename = basename($path);
            $dst='/storage/cat_images/'.$filename;
            //dd( );



        }                 
        $data = $request->only('category_name','description');
        // ClassName::method();
        $data['picture']=$dst;
        //dd($data);

        Category::create($data);

        return back()->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
