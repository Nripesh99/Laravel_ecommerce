<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEmail;
use App\Mail\OrderEmail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $a=showTags();
        
        $product = Product::paginate(8);
        $productArrived = Product::orderByDesc('created_at')->paginate(8);
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.index', compact('product', 'category', 'cartCount','productArrived'));
    }
    public function shop(int $page = 1)
    {
        if ($page !== 1) {
            $product = Product::all()->limit(10)->offset(($page - 1) * 9)->get();
        } else {
            $product = Product::paginate(9);
        }

        $pageCount = ceil(Product::count() / 9);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        $category = Category::all()->where('parent_id', null);
        return view('ecommerce.shop', compact('product', 'category', 'pageCount', 'cartCount'));
    }
    public function shopajax(Request $request)
    {
        $page = $request->page ?? 1;
        if ($page !== 1) {
            $products = Product::limit(9)->offset(($page - 1) * 9)->get();
        } else {
            $products = Product::paginate(9);
        }


        $category = Category::all()->where('parent_id', null);


        $pageCount = ceil(Product::count() / 9);

        $data = [
            'product' => $products,
            'category' => $category,
            'pageCount' => $pageCount
        ];

        return response()->json($data);
    }

    public function checkout(string $id)
    {
        $cart = Cart::all()->where('user_id', $id);
        $user = User::find(auth()->id());
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();

        return view('ecommerce.checkout', compact('cart', 'user', 'category', 'cartCount'));
    }
    public function orderStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_detail' => 'required|json',
            'total' => 'required|integer',
        ]);

        // Create a new order
        $order = new Order;
        $order->user_id = $request->input('user_id');
        $order->order_detail = $request->input('order_detail');
        $order->total = $request->input('total');
        $order->save();

        // Decode the JSON data
        $orderData = json_decode($order->order_detail);

        // Save order detail
        $orderdetail = array();
        foreach ($orderData as $orderDataItem) {
            $orderDetail = new Order_detail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $orderDataItem->product_id;
            $orderDetail->quantity = $orderDataItem->product_quantity;
            $orderDetail->price = $orderDataItem->totalPrice / $orderDataItem->product_quantity;
            $orderDetail->save();
            $orderdetail[] = $orderDetail->id;
            $stock = Stock::where('product_id', $orderDataItem->product_id)->first();
            if ($stock) {
                $stock->quantity -= $orderDataItem->product_quantity;
                $stock->save();
            }
        }
        //deleting stock

        //Deleting carts 
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }
        ProcessEmail::dispatch($orderdetail);
        return redirect()->route('frontend.showOrder')->with('success', 'Order placed successfully');

    }

    public function show(string $id)
    {
        $allProduct = Product::all();
        $product = Product::find($id);
        $category_id = Category::where('id', $product->category_id)->first();
        $subCategory = Category::findOrFail($category_id->id);
        $categoriesInBetween = $subCategory->ancestors()->pluck('category_name', 'id');
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.detail', compact('product', 'allProduct', 'category', 'categoriesInBetween', 'cartCount'));
    }

    public function cartShow()
    {
        $id = auth()->id();
        $category = Category::all()->where('parent_id', null);
        $cart = Cart::all()->where('user_id', $id);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.cart', compact('cart', 'category','cartCount'));
    }
    public function showOrder()
    {
        $orderId = Order::where('user_id', auth()->id())->pluck('id')->toArray();
        $order =Order_detail::whereIn('order_id', $orderId)->orderByDesc('id')->paginate(10);
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.order', compact('order', 'category','cartCount'));
    }
    public function contact(){
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.contact',compact('category', 'cartCount'));
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
    public function search(Request $request)
    {
        $search = $request->search;
        $page = $request->page ?? 1;
        $perPage = 9;

        $offset = ($page - 1) * $perPage;

        $product = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(9);
        // Calculate the total number of pages


        // You can retrieve categories and cart count if needed
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.search', compact('product', 'category', 'cartCount', 'search'));
    }

    public function searchCategory(Request $request)
    {

       
        $category_id = $request->category;
        $category = Category::findOrFail($category_id);
        $categoryId = array();
        foreach ($category->descendants() as $ancestor) {
            $categoryId[] = $ancestor->id;
        }
        $product = Product::whereIn('category_id', $categoryId)->paginate(9);
        $category = Category::all()->where('parent_id', null);
        $subCategory = Category::findOrFail($category_id);
        $categoriesInBetween = $subCategory->ancestors()->pluck('category_name', 'id');
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('ecommerce.search', compact('product', 'category', 'categoriesInBetween','cartCount'));
    }

}

