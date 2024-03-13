@extends('layouts.app')
@section('style')
    <style>
        .card {
            width: 300px;
            height: 200px;
            transition: all 0.3s ease;
            /* Add smooth transition */
        }

        .card:hover {
            width: 310px;
            /* Increase width on hover */
            height: 210px;
            /* Increase height on hover */
        }
    </style>
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    Header
                </div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('home') }}
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex mt-3 mx-2">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$productCount}}</h3>
                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">
                    Product Info<i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    User info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{$categoryCount}}</h3>
                    <p>Category </p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">
                    Category Info  <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{$stockCount}}</h3>
                    <p>Product Stock </p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{ route('stocks.index') }}" class="small-box-footer">
                    Stock Info  <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{$orderCount}}</h3>
                    <p>Product Order </p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Order Info  <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- <div class="col-4">
        <div class="card">
            <p class="card-text p-4 m-4">Product</p>
        </div>
    </div> --}}
    
@endsection
