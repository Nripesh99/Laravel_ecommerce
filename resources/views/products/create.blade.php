@extends('layouts.app')
@section('content')
    <style>
        #form {
            margin: auto;
            width: 80%;
            padding: 10px;
            height: 100%;
        }
        .backgroundButton {
            padding: 5px;
            border-radius: 5px;
            margin: 0px 5px 10px 0;
            width: 50px;
            height: 50px;
            display: block;
            text-align: center;
        }

        .backgroundColorChoice {
            display: flex;
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
                <label for="" class="mt-4 mb-3">Product Colors</label><br>
                <div class="backgroundColorChoice">
                    @foreach ($product_color as $productColor)
                        <input type="checkbox" name="colorValue[]" value="{{ $productColor->name }}" class="colorValue"
                            id="color-{{ $productColor->name }}" data-currentColor="color-{{ $productColor->name }}" >
                        <label class="backgroundButton" style="background-color: {{ $productColor->name }}"
                            for="color-{{ $productColor->name }}" data-productColor="{{ $productColor->name }}">
                        </label>
                    @endforeach
                </div>
                <br>
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Attribute:</label>
                <select name="attribute[]" class="form-control attribute " id="product_options" multiple>
                    @foreach ($option as $options)
                        <option value="{{ $options->id }}" data-name="{{ $options->name }}">{{ $options->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="variant_fields"></div>
            <div id="variant" class="mb-3">
            </div>

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Price:</label>
                <input type="text" class="form-control" name="price" id="price" required>
            </div>

            <div class="mb-3">
                <label for="sku" class="form-label">Product SKU:</label>
                <input type="text" class="form-control" name="SKU" id="SKU" required>
            </div>
            <input type="text" class="form-control" name="attribute" id="attribute">

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
            var selectedColors = {
                Colors: []
            };

            $('.colorValue').click(function() {
                var currentColor = $(this).val();
                $(this).toggleClass('clicked');

                // If the color is clicked, add it to the array; otherwise, remove it
                if ($(this).hasClass('clicked')) {
                    selectedColors.Colors.push(currentColor);
                } else {
                    var index = selectedColors.Colors.indexOf(currentColor);
                    if (index !== -1) {
                        selectedColors.Colors.splice(index, 1);
                    }
                }
                $('.optionName').trigger('change');

                // console.log(selectedColors); // Output the object with the selected colors
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
                        <input type="text" name="${optionName}" class="form-control optionName" placeholder="${optionName}" >
                    </div>
                `;

                        // Append generated HTML to the container
                        $('#variant_fields').append(variantFieldsHTML);
                    });
                }
                $('.optionName').change(function() {
                  
                    $('.combination').empty();   
                    var sizesMap = {};

                    $('.optionName').each(function() {
                        var optionName = $(this).attr('name');
                        var optionValue = $(this).val();
                        var sizesArray = optionValue.split(',').map(function(size) {
                            return size.trim();
                        });
                        sizesMap[optionName] = sizesArray;
                    });

                    var productName = $('#product_name').val();
                    //To find every combination of the product
                    function generateCombinationsMatrix(sizesMap) {
                        console.log(sizesMap);
                        // Get the sizes of each option
                        var sizes = Object.values(sizesMap);
                        // Initialize the matrix with the first option's sizes
                        var matrix = sizes[0].map(size => [size]);

                        // Iterate over the rest of the options
                        for (var i = 1; i < sizes.length; i++) {
                            var newMatrix = [];
                            // Iterate over each size of the current option
                            sizes[i].forEach(optionSize => {
                                // Duplicate each row in the matrix and append the current size
                                matrix.forEach(row => {
                                    newMatrix.push(row.concat(optionSize));
                                });
                            });
                            // Update the matrix
                            matrix = newMatrix;
                        }

                        return matrix;
                    }
                    let newMergeSizeMap;
                    
                    if (!selectedColors || !selectedColors.Colors || selectedColors.Colors
                        .length === 0) {
                        // If selectedColors is null, undefined, or Colors array is empty
                        newMergeSizeMap = {
                            ...sizesMap
                        };
                    } else if (!sizesMap || Object.keys(sizesMap).length === 0) {
                        // If sizesMap is null, undefined, or an empty object
                        newMergeSizeMap = {
                            ...selectedColors
                        };
                    } else {
                        // If both selectedColors and sizesMap exist
                        newMergeSizeMap = {
                            ...selectedColors,
                            ...sizesMap
                        };
                    }

                    var combinationsMatrix = generateCombinationsMatrix(newMergeSizeMap);
                    $('.delete-row-btn').click(function() {
                        $(this).closest('.row').remove();
                    });
                    combinationsMatrix.forEach(combination => {
                        var attributeField = `
                        <div class="row combination" id="${productName}-${combination.join('-')}">
                            <div class="mb-3 flex-container">
                                <label for="productName" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" id="productName" name="variantName[]" value="${productName}-${combination.join('-')}" readonly>
                            </div>
                            <div class="mb-3 flex-container">
                                <label for="${productName}${combination.join('-')}_price" class="form-label">Price:</label>
                                <input type="text" class="form-control" name="variantPrice[]" id="variantPrice">
                            </div>
                            <div class="mb-3 flex-container">
                                <label for="_stock" class="form-label">Stock:</label>
                                <input type="text" class="form-control" name="variantStock[]" id="stock">
                            </div>
                            <div class="mb-3 flex-container">
                                <label for="" class="form-label">Image:</label><br>
                            <input type="file" name="variantImage[]" id="image">
                            </div>
                        </div>

                        `

                        $('#variant').append(attributeField);
                        // console.log(combination.join('-'));
                    });
                    //removing number of unwanted attributes it's determined by - like Macbook-15inch- //
                    var rows = document.querySelectorAll('.row');
                    rows.forEach(function(row) {
                        var rowId = row.id;
                        if (rowId.charAt(rowId.length - 1) === '-') {
                            row.remove();
                        }
                    });
                    // console.log(newMergeSizeMap);
                    var jsonString = JSON.stringify(newMergeSizeMap);
                    $('#attribute').val(jsonString);


                });

            });

        });
    </script>
@endsection
