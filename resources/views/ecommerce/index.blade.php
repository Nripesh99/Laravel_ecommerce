@extends('layouts.app2')
@section('content')
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
                    </h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form id="searchForm" action="{{ route('frontend.search') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input id="searchInput" type="text" class="form-control" placeholder="Search for products"
                            name="search">
                        <div class="input-group-append">
                            <button id="searchButton" class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="{{route('frontend.showOrder')}}" class="btn border">
                    <i class="fas fa-bell text-primary"></i>
                    <span class="badge"></span>
                </a>
                @auth
                <a href="{{ route('carts.show', ['cart' => auth()->id()]) }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge" id="cartCount"></span>
                </a>
                @endauth
                @guest
                    <a href="{{ route('frontend.index') }}" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                @endguest

            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach ($category as $categories)
                            @if (isset($categories->subcategory))
                                <div class="nav-item dropdown">
                                    <a href="" class="nav-link"
                                        data-toggle="dropdown">{{ $categories->category_name }}<i
                                            class="fa fa-angle-down float-right mt-1"></i></a>
                                    <div class="nav-item dropdown">
                                        <div
                                            class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                            @foreach ($categories->subcategory as $subcategory)
                                                <a href="{{ route('frontend.searchCategory', ['category' => $subcategory->id, 'slug' => generateSlug($subcategory->category_name)]) }}"
                                                    class="dropdown-item">{{ $subcategory->category_name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="" class="nav-item nav-link">{{ $categories->category_name }}</a>
                            @endif
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold">
                            <span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
                        </h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('frontend.shop') }}" class="nav-item nav-link">Shop</a>
                            <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @auth
                                        <a href="{{ route('carts.show', ['cart' => auth()->id()]) }}"
                                            class="dropdown-item">Shopping Cart</a>
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="dropdown-item">Shopping Cart</a>

                                    @endguest
                                    <a href="{{ route('frontend.showOrder') }}" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            @guest
                                @if (Route::has('login'))
                                    <a class="nav-item nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="nav-item nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <div class="nav-item dropdown">
                                    @auth
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                            {{ Auth::user()->name }}</a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            @endguest
                        </div>
                    </div>
                </nav>

                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px">
                            <img class="img-fluid" src="{{ url('/images/' . 'carousel-1.jpg') }}" alt="Image" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        10% Off Your First Order
                                    </h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                        Fashionable Dress
                                    </h3>
                                    <a href="{{ route('frontend.searchCategory', ['category' => 2 ,'slug' => 'car']) }}"
                                        class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px">
                            <img class="img-fluid" src="{{ url('/images/' . 'carousel-2.jpg') }}" alt="Image" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        10% Off Your First Order
                                    </h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                        Reasonable Price
                                    </h3>
                                    <a href="{{ route('frontend.searchCategory', ['category' => 2 ,'slug' =>  'car']) }}"
                                        class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @foreach ($category as $categories)
                <div class="col-lg-4 col-md-6 pb-1">
                    <a href="{{route('frontend.searchCategory', ['category' => $categories->id,'slug'=>generateSlug($categories->category_name)])}}">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px">
                            <p class="text-right">
                                @php $count=0; @endphp
                                @foreach ($categories->descendants() as $child)
                                    @php $count=$child->product()->count()+$count;@endphp
                                @endforeach
                                {{ $count }}
                                Products
                            </p>
                            <a href="{{ route('frontend.searchCategory', ['category' => $categories->id,'slug'=>generateSlug($categories->category_name)]) }}"
                                class="cat-img position-relative overflow-hidden mb-3">
                                <img class="img-fluid" src="{{ url('/images/' . 'cat-6.jpg') }}" alt="" />
                            </a>
                            <h5 class="font-weight-semi-bold m-0">{{ $categories->category_name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->

    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="" />
                    <div class="position-relative" style="z-index: 1">
                        <h5 class="text-uppercase text-primary mb-3">
                            20% off the all order
                        </h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="img/offer-2.png" alt="" />
                    <div class="position-relative" style="z-index: 1">
                        <h5 class="text-uppercase text-primary mb-3">
                            20% off the all order
                        </h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-center mb-8">
                <h2 class="section-title px-5">
                    <span class="px-2">Trendy Products</span>
                </h2>
            </div>
            <div class="mb-4 mx-5">
                <h3><a href="{{ route('frontend.shop') }}">See more</a></h3>
            </div>
        </div>

        <div class="row px-xl-5 pb-3">
            @foreach ($product as $products)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a
                                href="{{ route('detail.show', ['product' => $products->id, 'slug' => generateSlug($products->name)]) }}">
                                <img class="img-fluid w-100" src="{{ url('/images/' . $products->image) }}"
                                    alt="" style=" min-height:200px; max-height: 200px" />
                            </a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $products->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>Rs. {{ $products->price }}</h6>
                                <h6 class="text-muted ml-2"></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('detail.show', ['product' => $products->id, 'slug'=>generateSlug($products->name)]) }}"
                                class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>ViewDetail</a>
                            <form id="add-to-cart-form-_{{$products->id}}" action="{{ route('carts.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="quantity" id="quantity" value="1">
                                <button type="submit" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>Add Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->

    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3">
                        <span class="bg-secondary px-2">Stay Updated</span>
                    </h2>
                    <p>
                        Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam
                        labore at justo ipsum eirmod duo labore labore.
                    </p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here" />
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-center mb-8">
                <h2 class="section-title px-5">
                    <span class="px-2">Just Arrived</span>
                </h2>
            </div>
            <div class="mb-4 mx-5">
                <h3><a href="{{ route('frontend.shop') }}">See more</a></h3>
            </div>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($productArrived as $products)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="{{ route('detail.show', ['product' => $products->id, 'slug' => generateSlug($products->name)]) }}">
                                <img class="img-fluid w-100" src="{{ url('/images/' . $products->image) }}"
                                    alt="" style=" min-height:200px; max-height: 200px" />
                            </a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $products->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>Rs. {{ $products->price }}</h6>
                                <h6 class="text-muted ml-2"></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('detail.show', ['product' => $products->id, 'slug' => generateSlug($products->name)]) }}"
                                class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>ViewDetail</a>
                            <form id="add-to-cart-form-_{{$products->id}}" action="{{ route('carts.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="quantity" id="quantity" value="1">
                                <button type="submit" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>Add Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="{{ url('/images/' . 'vendor-1.jpg') }}" alt="2" />
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ url('/images/' . 'vendor-2.jpg') }}" alt="2" />
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ url('/images/' . 'vendor-3.jpg') }}" alt="2" />
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ url('/images/' . 'vendor-4.jpg') }}" alt="2" />
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{ url('/images/' . 'vendor-5.jpg') }}" alt="2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
    <script>
$(document).ready(function() {
    $('[id^="add-to-cart-form-"]').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Extract product ID from form ID
        var productId = this.id.split('_')[1]; // Assuming your form IDs are in the format 'add-to-cart-form-_{productId}'
        
        // Gather form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData + '&product_id=' + productId, // Include product ID in the form data
            success: function(response) {
                // Display success message as a toaster notification
                if (response.status === 'success') {
                    toastr.success(response.message);
                    updateCartCount();
                } else {
                    toastr.error(response.message);
                    updateCartCount();

                }
            },
            error: function(xhr, status, error) {
                toastr.error(xhr.responseJSON.message);
                updateCartCount();

            }
        });
    });
            // Function to update cart count
            function updateCartCount() {
                $.ajax({
                    url: "{{route('frontend.cartCount')}}", // Replace with your server endpoint
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
            updateCartCount();
        });


    </script>
@endsection
