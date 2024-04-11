@extends('layouts.app')
@section('content')
    <style>
        #form {
            margin: auto;
            width: 58%;
            padding: 10px;
            height: 100%;
        }
    </style>


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        {{ Breadcrumbs::render('product.create') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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
                <label for="product_name" class="form-label">Product Attribute:</label>
                <select name="attribute[]" class="form-control attribute " id="product_options" multiple>
                    @foreach ($option as $options)
                        <option value="{{ $options->id }}" data-name="{{ $options->name }}">{{ $options->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="variant_fields"></div>
            <div id="variant">
                
            </div>

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Price:</label>
                <input type="text" class="form-control" name="price" id="price" required>
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

    <script>
$(document).ready(function() {
    $('.subCategoryOption').hide();
    $('#category').change(function() {
        var selectedCategoryId = $(this).val();
        $('.subCategoryOption').hide();
        $('.subCategoryOption[data-parent-id="' + selectedCategoryId + '"]').show();
    });

    // For product options
    $('#product_options').change(function() {
        // Clear previous content
        $('#variant_fields').empty();
        
        // Check if any option is selected
        if ($(this).val() && $(this).val().length > 0) {
            // Iterate over selected options
            $(this).find('option:selected').each(function() {
                var optionName = $(this).data('name');
                
                // Generate HTML for each selected option
                var variantFieldsHTML = `
                    <div>
                        <label for="${optionName}" class="form-label">${optionName}:</label>
                        <input type="text" name="${optionName}" class="form-control" placeholder="${optionName}">
                    </div>
                `;
                
                // Append generated HTML to the container
                $('#variant_fields').append(variantFieldsHTML);
            });
        }
    });
    $('#variant').change(function() {
        
    });
});
 </script>
@endsection
{{-- <div class="row">
    <div class="mb-3 flex-container">
        <label for="${optionName}_price" class="form-label">${optionName} Price:</label>
        <input type="text" class="form-control" id="${optionName}_price">
    </div>
    <div class="mb-3 flex-container">
        <label for="${optionName}_stock" class="form-label">${optionName} Stock:</label>
        <input type="text" class="form-control" id="${optionName}_stock">
    </div>
    <div class="mb-3 flex-container">
        <label for="${optionName}" class="form-label">${optionName} image:</label>
        <input type="file" name="image" id="image">
    </div>
</div>
     --}}
