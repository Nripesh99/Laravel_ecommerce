@extends('layouts.app2')
@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4 text-end">
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right mx-5" style="background-color: white !important">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                       
                        <li class="breadcrumb-item"><a href="#">Order</a></li>

                    </ol>
                </nav>
            
            </div>
        </div>
    </div>
</div>
<div class="content mt-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-11 ml-5">
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
                                @foreach ($order as $order)
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