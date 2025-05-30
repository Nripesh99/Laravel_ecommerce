<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order=Order_detail::paginate(10);
        return view('orders.index',['orders'=>$order]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|int',
            'order_detail'=>'required|string',
            'product_id'=>'required|int',
        ]);
        $order = new Order;
        $order->user_id=$request->input('user_id');
        $order->order_detail=$request->input('order-detail');
        $order->product_id=$request->input('product_id');
        $order->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order=Order::findOrFail($id);
        $category=Category::all()->where('parent_id',null);
        return view('orders.show', ['order'=> $order],['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.create',['orders'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'=>'required|int',
            'order_detail'=>'required|string',
            'product_id'=>'required|int',
        ]);
        $order=Order::findOrFail($id);
        $order->user_id=$request->input('user_id');
        $order->order_detail=$request->input('order-detail');
        $order->product_id=$request->input('product_id');
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order=Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('error','Deleted succesfully');
    }
}
