@extends('layouts.app')
<style>
    #form{
   margin: auto; 
   width: 50%; 
   padding:10px;
    }
</style>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('stock.create') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <form id='form' class="border p-4 rounded shadow" action="{{ route('stocks.store') }}" method="post" >
        @csrf
        <div class="text-center">
            <h1>Add Stocks</h1>
        </div>
        <label for="category" class="form-label">Select Product</label>
        <select name="product" id="product" class="form-control" required>
            <option value="" selected disabled>Select Product</option>
            @foreach ($product as $products)
                <option value="{{ $products->id }}">{{ $products->name }}</option>
            @endforeach
        </select>
        <label for="quantity">Add quantity</label>
        <input type="number" class="form-control" name="quantity" id="quantity">
        <div class="text-center">

            <button type="submit" id="submit" class="btn btn-primary mt-4 ">Add Product</button>
        </div>

    </form>
</div>
@endsection
