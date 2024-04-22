@extends('layouts.app2')
@section('content')

    <!-- Navbar End -->
    <style>
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
    {{-- @dd($productVariant) --}}
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4 text-end">
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right mx-5" style="background-color: white !important">
                    @if (Route::currentRouteName() === 'detail.show')
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                                @foreach ($categoriesInBetween as $category_id => $category_name)
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('frontend.searchCategory', ['category' => $category_id, 'slug' => generateSlug($category_name)]) }}">{{ $category_name }}</a>
                                    </li>
                                @endforeach
                                <li class="breadcrumb-item"><a href="#">{{ $product->name }}</a></li>

                            </ol>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ url('/images/' . $product->image) }}" alt="Image"
                                style="min-height:270px; max-height:565px  ">
                        </div>
                        @if ($productVariant->isEmpty())
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ url('/images/' . $product->image) }}" alt="Image"
                                    style="min-height:270px; max-height:565px  ">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ url('/images/' . $product->image) }}" alt="Image"
                                    style="min-height:270px; max-height:565px  ">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ url('/images/' . $product->image) }}" alt="Image"
                                    style="min-height:270px; max-height:565px  ">
                            </div>
                        @endif
                        @foreach ($productVariant as $variant)
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ url('/variant_images/' . $variant->image) }}"
                                    alt="Image" style="min-height:270px; max-height:565px  ">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <div class="d-flex">
                    <h3 class="font-weight-semi-bold d-flex" id="productName">{{ $product->name }}</h3>
                    <small class="pt-1 d-flex mx-2">(SKU: {{ $product->SKU }})</small>
                </div>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <div class="d-flex">
                    <h3 class="font-weight-semi-bold mb-4 d-flex">Rs {{ $product->price }} </h3>
                    <small class="pt-1 d-flex mx-2"> (stock quantity:
                        {{ isset($product->stock) ? $product->stock->quantity : '0' }})</small>
                </div>
                {{-- @dd($productVariant) --}}
                <p class="mb-4">
                    {{ str_limit($product->product_description, 100) }}
                </p>
                <!--Variant not needed for now -->
                @if ($product->color == !null)
                    @php
                        $product_color = explode(',', $product->color);
                    @endphp
                    <label for="" class="mt-4 mb-3">Product Colors</label><br>
                    <div class="backgroundColorChoice">
                        @foreach ($product_color as $productColor)
                            <input type="radio" name="Colors" value="{{ $productColor }}" class="colorValue "
                                id="Colors-{{ $productColor }}" data-currentColor="Colors-{{ $productColor }}">
                            <label class=" backgroundButton" style="background-color: {{ $productColor }}"
                                for="Colors-{{ $productColor }}" data-productColor="{{ $productColor }}">
                            </label>
                        @endforeach
                    </div>
                @endif
                @php
                    $attributes = json_decode($product->attribute);
                @endphp
                @if ($product->attribute == !null)
                    @foreach ($attributes as $attribute => $values)
                        @if ($attribute !== 'Colors')
                            <div class="d-flex mb-3">
                                <p class="text-dark font-weight-medium mb-0 mr-3">{{ $attribute }}:</p>
                                @foreach ($values as $key => $value)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input"
                                            id="{{ $attribute }}-{{ $key + 1 }}" value="{{ $value }}"
                                            name="{{ $attribute }}">
                                        <label class="custom-control-label"
                                            for="{{ $attribute }}-{{ $key + 1 }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endif
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" id="minus-btn">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="form-control text-center" name="quantity" id="quantity">1</div>
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" id="plus-btn">
                                <i class="fa fa-plus"></i>
                        </div>
                        </button>
                    </div>
                    @auth
                        @if ($product->attribute === null)
                            <form id="add-to-cart-form" action="{{ route('carts.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="variant" id="variant" value="0">
                                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="quantity" id="qty" value="1">

                                <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                                    Add To Cart</button>
                            </form>
                        @else
                            <form id="add-to-cart-form" action="{{ route('carts.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="variant" id="variant" value="1">
                                <input type="hidden" class="product_id" name="product_id" id="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="quantity" id="qty" value="1">

                                <button type="submit" disabled class="btn btn-primary px-3 attributebtn"><i
                                        class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                            </form>
                        @endif
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                            Add
                            To Cart</a>
                    @endguest
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Category:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark  font-weight-bold"
                            href="{{ route('frontend.searchCategory', ['category' => $product->category->id, 'slug' => generateSlug($product->category->category_name)]) }}">
                            {{ $product->category->category_name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1"><!--Opening or closing a tags -->
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{ $product->product_description }}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt
                            duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur
                            invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet
                            rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam
                            consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam,
                            ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr
                            sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                        style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no
                                            at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($allProduct as $allProducts)
                        <div class="card product-item border-0">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a
                                    href="{{ route('detail.show', ['product' => $allProducts->id, 'slug' => generateSlug($allProducts->name)]) }}">
                                    <img class="img-fluid w-100" src="{{ url('/images/' . $allProducts->image) }}"
                                        alt="" style=" min-height:200px; max-height: 200px" />
                                </a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $allProducts->name }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>Rs {{ $allProducts->price }}</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ route('detail.show', ['product' => $allProducts->id, 'slug' => generateSlug($allProducts->name)]) }}"
                                    class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-eye text-primary mr-1"></i>ViewDetail</a>

                                <form id="add-to-cart-form-_{{ $allProducts->id }}" action="{{ route('carts.store') }}"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ $allProducts->id }}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="quantity" id="quantity" value="1">
                                    <button type="submit" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Add Cart
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    <script>
        $(document).ready(function() {
            // Get the initial quantity value
            var quantity = parseInt($('#quantity').text());
            // Function to update the quantity display
            function updateQuantity(value) {
                $('#quantity').text(value);
                $('#qty').val(value);

            }

            // Click event for plus button
            $('#plus-btn').click(function() {
                // Increase quantity by 1
                quantity++;
                updateQuantity(quantity);
            });

            // Click event for minus button
            $('#minus-btn').click(function() {
                // Decrease quantity by 1 if quantity is greater than 0
                if (quantity > 1) {
                    quantity--;
                    updateQuantity(quantity);
                }
            });
            $('#add-to-cart-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Extract product ID from form ID
                var productId = this.id.split('_')[
                    1]; // Assuming your form IDs are in the format 'add-to-cart-form-_{productId}'

                // Gather form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Display success message as a toaster notification
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            updateCartCount();
                        } else {
                            toastr.error(response.message);
                        }
                        // location.reload(); // For demonstration purpose, you can update the cart UI instead
                        // Refresh the page or update the cart UI as needed
                    },
                    error: function(xhr, status, error) {
                        // Display error message as a toaster notification
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            function updateCartCount() {
                $.ajax({
                    url: "{{ route('frontend.cartCount') }}", // Replace with your server endpoint
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#cartCount').text(JSON.stringify(data));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cart count:', error);
                    }
                });
            }
            //function to go to the cart.
        });

        $(document).ready(function() {
            // JavaScript
            var attributes = {}; // Object to store attribute name-value pairs
            var existingAttr =  {!! $product->attribute ?? 'null' !!};
            var productVariant = {!! $productVariant !!};
            console.log(productVariant);

            var attributeOrder = Object.keys( existingAttr); //finding the order of attribute so it could be easily used
            var productName = $("#productName").text();
            console.log(productName);
            $('input[type="radio"]').change(function() {
                var attributeName = $(this).attr('name'); // Get the attribute name
                var attributeValue = $(this).val(); // Get the attribute value

                var index = attributeOrder.indexOf(attributeName);
                if (index !== -1) {
                    attributes[attributeName] = attributeValue;
                }
                // Reconstruct the formatted string in the predefined order
                var formattedString = productName + '-' + attributeOrder.map(function(attr) {
                    return attributes[attr] || ''; // Use empty string if attribute value is not set
                }).join('-');
                console.log(formattedString);
                //check whether formatted string contains in productVariant


                //finding the id of the clicked product
                function findVariantIdByName(variants, name) {
                    const variant = variants.find(variant => variant.name === name);
                    return variant ? variant.id : null;
                }
                const variantId = findVariantIdByName(productVariant, formattedString);
                $('.product_id').val(variantId);
                console.log("Variant ID:", variantId);


                
                // Update or add the attribute in the object
                attributes[attributeName] = attributeValue;
                var newAttribute = {!! $product->attribute ?? 'null' !!};
                console.log(newAttribute);
                console.log(attributes);
                var formattedString = Object.values(attributes).join('-');
                // Function to check if the values in b exist in arrays corresponding to keys in a
                function valuesExistInArrays(a, b) {
                    for (let key in b) {
                        if (a.hasOwnProperty(key)) {
                            if (Array.isArray(a[key]) && a[key].includes(b[key])) {
                                continue;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    }
                    return true;
                }

                // Check if values of b exist within arrays corresponding to keys in a
                let valuesExist = valuesExistInArrays(newAttribute, attributes);
                console.log(valuesExist);

                // Check if there is at least one selected option for each attribute
                var allAttributesSelected = true;
                $('input[type="radio"]').each(function() {
                    var name = $(this).attr('name');
                    if (!attributes[name]) {
                        allAttributesSelected = false;
                        return false; // Break the loop if at least one attribute is not selected
                    }
                });

                // Enable or disable the button based on whether all attributes are selected and values exist
                $('.attributebtn').prop('disabled', !(allAttributesSelected && valuesExist));
            });
        });
    </script>
@endsection
