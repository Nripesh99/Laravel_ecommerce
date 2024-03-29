@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
                <a class="btn btn-primary" href="{{ route('products.create') }}">Add</a>
            </div>
            <div class="col-sm-4 text-end">
                <h3>Product table</h3>
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
                                    <th>S,no</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>SKU</th>
                                    <th>Product Description</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                    $category_name=[];
                                @endphp
                                @foreach ($product as $products)
                                <tr>
                                    <td>{{ $index}}</td>
                                    <td>{{ $products->name }}</td>
                                    <td>{{ $products->price }}</td>
                                    <td>{{ $products->SKU }}</td>
                                    <td>{{ $products->product_description }}</td>
                                    @foreach($products->category->descendants() as $categories)
                                    <td>{{$categories->category_name}}</td>
                                    @endforeach
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
<!-- /.content -->
@endsection