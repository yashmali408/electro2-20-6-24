<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

//Class ChildClass extends ParentClass{}
// Single Inheritance
// THis is an example of single inheritance
//CategoryController is resource controller
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get category from db
        //1. QueryBuilder
        //2. Eleqouent ORM (Object Relation Mapper)
                    //ClassName::method()
        $categories = Category::all();
        //dd($categories);

        // Then pass the category to view
        
        // Return is the last statemetn for every function
        //'index';//
        return view('admin.category.index',['categories'=>$categories]);
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
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Brand::
        // $dst='/storage/brand_images/'.$filename;
        //$brand->brand_logo contain the url
        // Get the filename from the brand's logo URL
        $filename = basename($category->picture);

        // Define the storage path for the logo
        $storagePath = 'public/cat_images/' . $filename;
        //dd($storagePath);

        // Check if the file exists and delete it
        if (Storage::exists($storagePath)) {
            Storage::delete($storagePath);
        }
        $category->delete();

        return back()->with('success','Category Deleted Successfully!');
    }
}