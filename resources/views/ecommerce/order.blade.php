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
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>

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
                                        <th class="text-center">Prouct Image</th>
                                        <th class="text-center">Product Price</th>
                                        <th class="text-center">Product Quantity</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Order By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($order as $orders)
                                        <tr>
                                            <td class="text-center">{{ $index }}</td>
                                            <td class="text-center">{{ $orders->products->name }}</td>
                                            <td class="img-fluid justify-content-center">
                                                <img src="{{ url('/images/' . $orders->products->image) }}" alt=""
                                                 style="max-width:100%; max-height:100px;">
                                            </td>
                                            <td class="text-center">Rs. {{ $orders->price }}</td>
                                            <td class="text-center">{{ $orders->quantity }}</td>
                                            <td class="text-center">{{ formatDate($orders->created_at) }}</td>
                                            <td class="text-center">{{ $orders->orders->user->name }}</td>
                                        </tr>
                                        @php
                                            $index++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                        {{ $order->links() }}
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
