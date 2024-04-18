<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Category;

use App\Models\ProductColor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $product = Product::all();
        
        return view('products.index', compact('product'));
    }
    public function create()
    {
        $categories=Category::all();
        $option=Attribute::all();
        $product_color=ProductColor::all();
        return view('products.create', compact('categories','option','product_color'));
    }
    public function store(Request $request) :RedirectResponse
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string',
            'subCategory' => 'nullable|string',
            'price'=>'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'SKU' => 'required|unique:products,SKU|string|max:255',
            'product_description' => 'required|string',
            'attribute' => 'nullable|string',
            'variantImage.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'variantPrice.*' => 'numeric',
            'variantStock.*' => 'numeric',
            'variantName.*' => 'string',
        ]);
        $profileImage = null;
     
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $profileImage = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $profileImage);
        }
        $addProduct = new Product;
        $addProduct->name = $request->input('product_name');
        $addProduct->price = $request->input('price');  
        $addProduct->user_id = auth()->id();
        $addProduct->category_id = $request->filled('subCategory') ? $request->input('subCategory') : $request->input('category');
        $addProduct->image = $profileImage; // Assign the file name, not the input value
        $addProduct->isVariant= 0;
        $addProduct->SKU = $request->input('SKU');
        $addProduct->product_description = $request->input('product_description');
        $addProduct->save();
        // return redirect()->route('products.show', ['product' => $addProduct->id]);
        $notification = array(
            'message' => 'added product succesfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    public function show(){

    }
    public function edit(Product $product){
            return view('product\edit', ['products' =>$product ]);
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'SKU' => 'required|unique:products,SKU|string|max:255',
            'product_description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImage);
            $product->image = $profileImage;
        }
        $product = Product::findOrFail($request->id);
        $product = new Product;
        $product->name = $request->input('name');
        $product->user_id = $request->input('user_id');
        $product->category_id = $request->input('category_id');
        $product->image = $profileImage; 
        $product->SKU = $request->input('SKU');
        $product->product_description = $request->input('product_description');
        $product->save();
        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('products.create')->with($notification);
    }
    
    public function delete($blog)
    {
        $post = Product::find($blog);
        $post->delete();
        $notification = array(
            'message' => 'delete successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('blogs.my')->with($notification);
    }
}

