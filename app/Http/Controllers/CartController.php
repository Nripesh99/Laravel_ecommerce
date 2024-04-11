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
        $category = Category::all()->where('parent_id', null);
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
            'product_id' => 'required|exists:products,id|min:1',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $existingProduct = Cart::where('product_id', $request->input('product_id'))
                                ->where('user_id', $request->input('user_id'))
                                ->first();
    
        $existingPerson = User::find($request->input('user_id'));
    
        if ($existingProduct && $existingPerson) {
            $cart = $existingProduct;
            $actualQuantity = Stock::where('product_id', $request->input('product_id'))->first();
    
            if ($actualQuantity->quantity <= 0 || $request->input('quantity') > $actualQuantity->quantity) {
                return response()->json(['message' => 'No stock present', 'status' => 'error']);
            }
    
            if ($cart->quantity + $request->input('quantity') > $actualQuantity->quantity) {
                return response()->json(['message' => 'Cart quantity greater than stock', 'status' => 'error']);
            }
    
            $cart->quantity += $request->input('quantity');
            $cart->save();
            return response()->json(['message' => 'Added to cart', 'status' => 'success']);
        } else {
            $cart = new Cart;
            $actualQuantity = Stock::where('product_id', $request->input('product_id'))->first();
    
            if ($actualQuantity === null || $actualQuantity->quantity <= 0 || $request->input('quantity') > $actualQuantity->quantity) {
                return response()->json(['message' => 'No stock present', 'status' => 'error']);
            }
    
            $cart->user_id = $request->input('user_id');
            $cart->product_id = $request->input('product_id');
            $cart->quantity += $request->input('quantity');
            $cart->save();
            return response()->json(['message' => 'Added to cart', 'status' => 'success']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::all()->where('user_id', $id);
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();

        return view('ecommerce.cart', compact('cart', 'category', 'cartCount'));
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
            $notification = array(
                'message' => 'Cart item not found',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        // Find the stock for the product
        $actualQuantity = Stock::where('product_id', $existingCart->product_id)->first();
        if ($actualQuantity === null) {
            $notification = array(
                'message' => 'No stock present',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        if ($actualQuantity->quantity <= 0 || $request->quantity > $actualQuantity->quantity) {
            $notification = array(
                'message' => 'Not enough stock available',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        $existingCart->quantity = $request->quantity;
        $existingCart->save();
        $notification = array(
            'message' => 'Cart item updated successfully',
            'alert-type' =>'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        $notification = array(
            'message' => 'deleted succesfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
