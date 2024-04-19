<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock=Stock::all();
        return view('stocks.index',compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product=Product::where('isVariant', 0)->get();
        return view('stocks.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product'=>'required|string',
            'quantity'=>'required|int',
        ]);
        $stock = new Stock;
        $quantityToAdd = $request->input('quantity');
        $existingRecord=Stock::where('product_id',$request->input('product'))->first();
        if($existingRecord){
            $stocks =Stock::find($existingRecord->id);
            $stocks->quantity += $quantityToAdd;
            $stocks->save();
        }
        else{
            
            $stock->product_id=$request->input('product');
            $stock->quantity=$request->input('quantity');
            $stock->save();
        }
        $notification = array(
            'message' => 'Added items stock ',
            'alert-type' => 'success',
        );
        return back()->with($notification);
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
