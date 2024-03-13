@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="{{ route('stocks.create') }}">Add</a>
                </div>
                <div class="col-sm-4 text-center">
                    <h3>Stock table</h3>
                </div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        {{ Breadcrumbs::render('stock') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex mt-3 mx-2">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">S,no</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($stock as $stocks)
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $stocks->product->name }}</td>
                        <td>{{ $stocks->quantity }}</td>
                        @php
                            $count++;
                        @endphp
                </tr>
                @endforeach
        </table>
    </div>
@endsection
