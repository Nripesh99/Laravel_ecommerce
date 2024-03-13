@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="{{route('categories.create')}}">Add</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <h3>Category table</h3>
                  </div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        {{ Breadcrumbs::render('category') }}
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
                    <th scope="col">Category Name</th>
                    <th class="rowspan-3" scope="col">Category Parent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                        $count=1;
                    @endphp
                    @foreach ($category as $categories)
                        <th scope="row">{{$count}}</th>
                        <td>{{ $categories->category_name }}</td>
                        <td>
                            @php
                                $subcategoriesNames = '';
                            @endphp
                            @foreach ($categories->subcategory as $subcategory)
                                {{ $subcategory->category_name }}@if (!$loop->last), @endif
                                @php
                                    $subcategoriesNames .= $subcategory->category_name . ($loop->last ? '' : ', ');
                                @endphp
                            @endforeach
                        </td>
                    </tr>
                        @php
                            $count++;
                        @endphp
                          @endforeach
                        
              </table>
            </div>
@endsection
