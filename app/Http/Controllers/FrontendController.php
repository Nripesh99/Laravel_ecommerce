<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=Product::all();
        $category=Category::all()->where('parent_id', null);
        return view('ecommerce.index',compact('product', 'category'));
    }
    public function checkout(string $id)
    {
        $cart=Cart::all()->where('user_id', $id);
        $user=User::find(auth()->id());
        return view('ecommerce.checkout', compact('cart','user'));
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
    public function show(string $id)
    {
        $product=Product::find($id);
        $allProduct=Product::all();
        return view('ecommerce.detail', compact('product', 'allProduct'));
    }
    public function cartShow(){
        $id=auth()->id();
        $cart=Cart::all()->where('user_id', $id);
        return view('ecommerce.cart',compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
