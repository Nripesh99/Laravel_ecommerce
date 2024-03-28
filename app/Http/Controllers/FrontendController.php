<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
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
        $product = Product::all();
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::all()->count();
        return view('ecommerce.index', compact('product', 'category', 'cartCount'));
    }
    public function shop(int $page = 1)
    {
        if ($page !== 1) {
            $product = Product::all()->limit(10)->offset(($page - 1) * 9)->get();
        } else {
            $product = Product::paginate(9);
        }

        $pageCount = ceil(Product::count() / 9);

        $category = Category::all()->where('parent_id', null);
        return view('ecommerce.shop', compact('product', 'category', 'pageCount'));
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

        return view('ecommerce.checkout', compact('cart', 'user', 'category'));
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

        // Save order details
        foreach ($orderData as $orderDataItem) {
            $orderDetail = new Order_detail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $orderDataItem->product_id;
            $orderDetail->quantity = $orderDataItem->product_quantity;
            $orderDetail->price = $orderDataItem->totalPrice / $orderDataItem->product_quantity;
            $orderDetail->save();
        }
        //Deleting carts 
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }
        return redirect()->route('frontend.index')->with('success', 'Order placed successfully');
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
        $product = Product::find($id);
        $allProduct = Product::all();
        $category = Category::all()->where('parent_id', null);

        return view('ecommerce.detail', compact('product', 'allProduct', 'category'));
    }

    public function cartShow()
    {
        $id = auth()->id();
        $cart = Cart::all()->where('user_id', $id);
        return view('ecommerce.cart', compact('cart'));
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

        // $product = Product::where('name', 'LIKE', '%' . $search . '%')
        //     ->skip($offset)
        //     ->take($perPage)
        //     ->get();
        $product= Product::where('name', 'LIKE', '%' . $search . '%')->paginate(9);
        // Calculate the total number of pages
       

        // You can retrieve categories and cart count if needed
        $category = Category::all()->where('parent_id', null);
        $cartCount = Cart::count();

        return view('ecommerce.search', compact('product', 'category', 'cartCount'));
    }

    public function searchCategory(Request $request){
        $page = $request->page ?? 1;
        $perPage = 9; 
        $offset = ($page - 1) * $perPage;
        $category_id=$request->category;
        $product=Product::where('category_id', $category_id)
        ->skip($offset)
        ->take($perPage)
        ->get();
        $category = Category::all()->where('parent_id', null);
        $totalCount=Product::where('category_id', $category_id)->count();
        $pageCount = ceil($totalCount / $perPage);
        $cartCount = Cart::count();

        return view('ecommerce.search', compact('product', 'category', 'pageCount', 'cartCount'));


    }

}

