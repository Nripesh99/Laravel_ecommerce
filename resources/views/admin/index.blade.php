@extends('layouts.adminnavigation')
@section('style')
<style>
.card {
    width: 300px;
    height: 200px;
    transition: all 0.3s ease; /* Add smooth transition */
}

.card:hover {
    width: 310px; /* Increase width on hover */
    height: 210px; /* Increase height on hover */
}
</style>
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card" >
                        <p class="card-text p-4 m-4">Product</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" >
                        <p class="card-text p-4 m-4">Product</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" >
                        <p class="card-text p-4 m-4">Product</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card" >
                        <p class="card-text p-4 m-4">Product</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" >
                        
                        <a href="{{route('products.create')}}">
                            <p class="card-text p-4 m-4">Product</p>
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" >
                        <a href="{{route('products.create')}}">
                            <p class="card-text p-4 m-4">Product</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
