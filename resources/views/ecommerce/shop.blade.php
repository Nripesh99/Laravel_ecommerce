@extends('layouts.app2')
<style>
    /*  */
</style>
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4 text-end">
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right mx-5" style="background-color: white !important">
                    <!-- Content goes here -->
                    @if (Breadcrumbs::exists(Route::currentRouteName()))
                        {{ Breadcrumbs::render(Route::currentRouteName()) }}
                    @else
                        {{ Route::currentRouteName() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all" />
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal"></span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1" />
                            <label class="custom-control-label" for="price-1">Rs. 0 - Rs. 100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2" />
                            <label class="custom-control-label" for="price-2">Rs. 100 - Rs. 200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3" />
                            <label class="custom-control-label" for="price-3">Rs. 200 - Rs. 300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4" />
                            <label class="custom-control-label" for="price-4">Rs. 300 - Rs. 400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5" />
                            <label class="custom-control-label" for="price-5">Rs. 400 - Rs. 500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all" />
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1" />
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2" />
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3" />
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4" />
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5" />
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all" />
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1" />
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2" />
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3" />
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4" />
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5" />
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class='row pb-3'>
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name" />
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3" id="productContainer"><!--Product is inside this -->
                </div>


                <div class="col-12 pb-1" id="pagenavigation">
                    @if ($pageCount > 0)
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @php
                                    $counter = 1;
                                @endphp
                                @for ($i = 1; $i <= $pageCount; $i++)
                                    <li class="page-item ">
                                        <a class="page-link"
                                            href="{{ route('frontend.shop', ['page' => $counter]) }}">{{ $counter }}</a>
                                        {{-- <a class="page-link">{{ $counter }}</a> --}}
                                    </li>
                                    @php
                                        $counter++;
                                    @endphp
                                @endfor
                                <a class="page-link" href="{{ route('frontend.shop') }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    </div>
    <script>
        $(document).ready(function() {
            // Function to handle form submission
            function slugify(str) {
                return String(str)
                    .normalize('NFKD') // split accented characters into their base characters and diacritical marks
                    .replace(/[\u0300-\u036f]/g,
                        '') // remove all the accents, which happen to be all in the \u03xx UNICODE block.
                    .trim() // trim leading or trailing whitespace
                    .toLowerCase() // convert to lowercase
                    .replace(/[^a-z0-9 -]/g, '') // remove non-alphanumeric characters
                    .replace(/\s+/g, '-') // replace spaces with hyphens
                    .replace(/-+/g, '-'); // remove consecutive hyphens
            }

            function loadProducts(pageNumber) {
                $.ajax({
                    url: "{{ route('frontend.shopajax') }}",
                    type: "GET",
                    data: {
                        page: pageNumber
                    },
                    dataType: "json",
                    success: function(data) {
                        const products = data.product;
                        let combinedHtml = '';
                        products.forEach(function(product) {
                            combinedHtml += `
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="/images/${product.image}" alt="" style="min-height:200px; max-height: 200px" />
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">${product.name}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>Rs. ${product.price}</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="/ecommerce/${product.id}-${slugify(product.name)}" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-eye text-primary mr-1"></i>View Detail
                                    </a>
                                    <form id="add-to-cart-form-_${product.id}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="${product.id}">
                                            <input type="hidden" name="user_id" value="${product.user_id}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"  class="btn btn-sm text-dark p-0">
                                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add Cart
                                            </button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    `;
                        });

                        $('#productContainer').html(combinedHtml);
                    },
                    error: function(xhr, status, error) {
                        console.log("error", error);
                        // Handle error if any
                    }
                });
            }


            // Call the function with page number 1
            loadProducts(1);

            // Event listener for page links
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault(); // Prevent default click behavior

                var pageNumber = $(this).text(); // Extract page number from link text
                loadProducts(pageNumber);

            });

            function handleFormSubmission() {

                $('[id^="add-to-cart-form-"]').on('submit', function(e) {
                    console.log("Form submission");
                    var productId = this.id.split('_')[1]; // Assuming your form IDs are in the format 'add-to-cart-form-_{productId}'
                    e.preventDefault(); // Prevent default form submission
                    var form = $(this);
                    var formData = form.serialize(); // Serialize form data
                    $.ajax({
                        url: "{{ route('carts.store') }}",
                        type: "POST",
                        data: formData + '&product_id=' +
                            productId, // Include product ID in the form data
                        success: function(response) {
                            // Handle success response
                            console.log(response);
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                updateCartCount();

                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error(" ", error);
                            // Handle error if any
                        }
                    });
                });
            }
            setTimeout(function() {
                handleFormSubmission(); // Call the form submission function
            }, 4000);

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
        });
    </script>

@endsection

<!-- Shop End -->
