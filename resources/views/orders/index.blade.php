@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4 text-end">
                <h2>Order table</h2>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('product') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="product_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">S,no</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Product Price</th>
                                    <th class="text-center">Product Quantity</th>
                                    <th class="text-center">Order By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                @endphp
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $index}}</td>
                                    <td class="text-center">{{ $order->products->name }}</td>
                                    <td class="text-center">{{ $order->price }}</td>  
                                    <td class="text-center">{{$order->quantity}}</td>
                                    <td class="text-center">{{ $order->orders->user->name }}</td>
                                    
                                </tr>
                                @php
                                    $index++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection