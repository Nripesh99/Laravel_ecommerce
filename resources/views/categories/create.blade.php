@extends('layouts.app')
@section('content')
<style>
    #form{
   margin: auto; 
   width: 50%; 
   height: 50%;
    }
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('category.create') }}
                </div>
            </div>
        </div>
    </div>
</div>
   <div class="container mt-5">
    <div class="text-center p-4">
        <div class="border p-4 rounded shadow">
            <div class="row justify-content-center mt-2">
                <div class="col-8 col-md-4">
                    <h3 class="mt-5">Add category</h3>
                    <form class="form-group" action="{{route('categories.store')}}" method="post">
                        @csrf
                        <input type="text" name="category_name" id="category_name" class="form-control">
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-8 col-md-4">
                    <h3 class="mt-5">Add Sub Category</h3>
                    <form class="form-group" action="{{route('categories.store')}}" method="post">
                        @csrf
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="" selected disabled>Select Category</option> 
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="category_name" id="category_name" class="form-control">
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Add Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>    
</div> 
@endsection
