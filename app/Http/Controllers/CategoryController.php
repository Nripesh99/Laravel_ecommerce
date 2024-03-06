<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('categories.index',compact('category'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $subcategories = Category::whereNotNull('parent_id')->get();
        return view('categories.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name'=>'required|string',
            'parent_id'=>'nullable|int',
        ]);
        $category = new Category;
        $category->category_name=$request->input('category_name');
        $category->parent_id=$request->input('parent_id');
        $category->save();
        return redirect()->back()->with('success','Categories added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('category_id',  "$id")->get();
        if ($product->isEmpty()) {
            return redirect()->back()->with('error', 'No product found');
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('categories.edit',['category'=>$category]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'=>'required|string',
        ]);
        $category =Category::findOrFail($category->id);
        $category->name=$request->input('category_name');
        $category->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('error', 'deleted succesfully');

    }
}
