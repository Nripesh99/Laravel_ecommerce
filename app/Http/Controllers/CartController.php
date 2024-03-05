<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart=Cart::all();
        return view('carts.index',['carts'=>$cart]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $cart = new Cart;
        $cart->user_id=$request->input('user_id');
        $cart->product_id=$request->input('product_id');
        $cart->quantity=$request->input('quantity');
        $cart->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        return view('carts.edit',['carts',$cart]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cart= Cart::findOrFail($cart->id);
        $cart->quantity=$request->input('quantity');
        $cart->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart =Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('error', 'deleted succesfully');
    }
}
