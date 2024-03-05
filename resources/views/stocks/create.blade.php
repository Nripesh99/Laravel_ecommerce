@extends('layouts.adminnavigation')
@section('content')
<div class="container mt-5">
    <form id='form' class="border p-4 rounded shadow" action="{{ route('stocks.add') }}" method="post" >
        @foreach($product as $product)
        {{$product}}
        @endforeach
    </form>
</div>

@endsection
