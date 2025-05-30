<div class="container-fluid" id='nav1'>
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
            <a href="{{ route('frontend.index') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
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
            <a href="{{ route('frontend.showOrder') }}" class="btn border">
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
                <a href="{{ route('login') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"></span>
                </a>
            @endguest
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid" id="nav2">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 3;">
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
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('frontend.index') }}" class="nav-item nav-link">Home</a>
                        <a href="{{ route('frontend.shop') }}" class="nav-item nav-link">Shop</a>
                        <a href="{{ route('frontend.shop') }}" class="nav-item nav-link active">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                @auth
                                    <a href="{{ route('carts.show', ['cart' => auth()->id()]) }} "
                                        class="dropdown-item">Shopping Cart</a>
                                @endauth
                                @guest
                                    <a href="{{ route('login') }} " class="dropdown-item">Shopping Cart</a>

                                @endguest
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="{{ route('frontend.contact') }}" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
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
                        </div>
                    @endguest
                </div>
        </div>
        </nav>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Function to update cart count
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

        // Call updateCartCount initially and then every 5 seconds
        updateCartCount();

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
                data: formData + '&product_id=' +
                productId, // Include product ID in the form data
                success: function(response) {
                    // Display success message as a toaster notification
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        updateCartCount();

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Display error message as a toaster notification
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>