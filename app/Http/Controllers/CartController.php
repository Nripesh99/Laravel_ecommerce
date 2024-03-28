<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::all();
        $cart = Cart::all();
        return view('carts.index', ['carts' => $cart], ['category' => $category]);

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
        // Find whether the product already exists in the cart
        $existingProduct = Cart::where('product_id', $request->input('product_id'))
        ->where('user_id', $request->input('user_id'))
        ->first();
        
        // Find whether the user already exists
        
        $existingPerson = User::find($request->input('user_id'));

        if ($existingProduct && $existingPerson) {
            $cart = $existingProduct;
            $actualQuantity = Stock::where('product_id', $request->product_id)->first();
            if ($actualQuantity->quantity <= 0 || $request->input('quantity') > $actualQuantity->quantity) {
                return back()->with('error', 'No stock present');
            }

            $cart->quantity += $request->input('quantity');
            $cart->save();
            return back()->with('success', 'Added to cart');
        } else {
            $cart = new Cart;
            $actualQuantity = Stock::where('product_id', $request->product_id)->first();
            if($actualQuantity === null){
                return back()->with('error', 'No stock present');
            }
            if ($actualQuantity->quantity <= 0 || $request->input('quantity') > $actualQuantity->quantity) {
                return back()->with('error', 'No stock present');
            }

            $cart->user_id = $request->input('user_id');
            $cart->product_id = $request->input('product_id');
            $cart->quantity += $request->input('quantity');
            $cart->save();
            return back()->with('success', 'Added to cart');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart=Cart::all()->where('user_id', $id);
        $category=Category::all();
        return view('ecommerce.cart', compact('cart','category'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        return view('carts.edit', ['carts', $cart]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        // Find the existing cart item
        $existingCart = Cart::find($cart->id);
        if (!$existingCart) {
            return back()->with('error', 'Cart item not found');
        }
        // Find the stock for the product
        $actualQuantity = Stock::where('product_id', $existingCart->product_id)->first();
        if ($actualQuantity === null) {
            return back()->with('error', 'No stock present');
        }
        if ($actualQuantity->quantity <= 0 || $request->quantity > $actualQuantity->quantity) {
            return back()->with('error', 'Not enough stock available');
        }
        $existingCart->quantity = $request->quantity;
        $existingCart->save();
        return back()->with('success', 'Cart item updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('error', 'deleted succesfully');
    }
}
