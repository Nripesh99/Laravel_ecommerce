@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                  <a class="btn btn-primary" href="{{route('products.create')}}">Add</a>
                </div>
                <div class="col-sm-4 text-center">
                  <h3>Product table</h3>
                </div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        {{ Breadcrumbs::render('product') }}
                    </div>
                </div>
            </div>
        </div>
        
          <div class=" float-sm-right">
          </div>
   
    </div>
  
    <div class="row d-flex mt-3 mx-2">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">S,no</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($product as $products)
                        <th scope="row">1</th>
                        <td>{{ $products->name }}</td>
                        <td>{{ $products->SKU }}</td>
                        <td>{{ $products->product_description }}</td>
                        <td> {{ $products->category->category_name }}</td>
                        
                    </tr>
                    @endforeach
              </table>
            </div>
@endsection
