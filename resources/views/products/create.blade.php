@extends('layouts.adminnavigation')
<style>
     #form{
    margin: auto; 
    width: 50%; 
    padding:10px;
    height:100%;
}

</style>

@section('content')
    <div class="error">
        <p class="error"></p>
    </div>
    <div class="container mt-5">
        <form id='form' class="border p-4 rounded shadow" action="{{ route('products.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="text-center">
                <h1>Add Products</h1>
            </div>
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="" selected disabled>Select Category</option>
                @foreach ($categories->where('parent_id', null) as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>

            <label for="subCategory" class="form-label">SubCategory</label>
            <select name="subCategory" id="subCategory" class="form-control">
                <option value="" selected disabled>Select Subcategory</option>
                @foreach ($categories->whereNotNull('parent_id') as $subcategory)
                    <option value="{{ $subcategory->id }}" class="subCategoryOption"
                        data-parent-id="{{ $subcategory->parent_id }}">{{ $subcategory->category_name }}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>

            <div class="mb-3">
                <label for="sku" class="form-label">Product SKU:</label>
                <input type="text" class="form-control" name="SKU" id="SKU" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Product Description:</label>
                <textarea class="form-control" name="product_description" id="product_description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit" id="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.subCategoryOption').hide();
            $('#category').change(function() {
                var selectedCategoryId = $(this).val();
                $('.subCategoryOption').hide();
                // Show only relevant subcategory options
                $('.subCategoryOption[data-parent-id="' + selectedCategoryId + '"]').show();
            });
        });
    </script>
@endsection
