@extends('layouts.app2')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4 text-end">
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right mx-5" style="background-color: white !important">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('carts.show',['cart'=>auth()->id()])}}">Cart</a></li>
                            
                            <li class="breadcrumb-item"><a href="#">Checkout</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <!--Send detail data from controller -->
    
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" value="{{ trim(explode(' ', $user->name)[0]) }}"
                                readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>

                            <input class="form-control" type="text" value="{{ trim(explode(' ', $user->name)[1]) }}"
                                readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        {{-- <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div> --}}
                        {{-- <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div> --}}
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="Kathmandu Kathmandu">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="Kathmandu Kathmandu">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="446600">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                    data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" value="{{ trim(explode(' ', $user->name)[0]) }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" value="{{ trim(explode(' ', $user->name)[1]) }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text"value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>Nepal </option>
                                <option>India</option>
                                <option>China</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        @php
                            $subtotal=0;
                        @endphp
                        @foreach ($cart as $carts)
                            <div class="d-flex justify-content-between">
                                <p>{{ $carts->product->name }} ({{ $carts->quantity }})</p>
                                <p id="price_{{ $carts->id }}">Rs. 
                                    @php
                                        $totalPrice = $carts->product->price * $carts->quantity; 
                                        $subtotal += $totalPrice; 
                                    @endphp
                                    {{ $totalPrice }}
                                    @php
                                        $orderJson[]= [
                                            'product_id'=>$carts->product->id,
                                            'product_name'=>$carts->product->name,
                                            'product_quantity'=>$carts->quantity,
                                            'totalPrice' =>$totalPrice,
                                       ];
                                    @endphp
                                </p>
                            </div>
                        @endforeach
                        @php
                            
                        @endphp


                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$s. {{$subtotal}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Rs 0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="total">${{$subtotal}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Cash On Delivery</label>
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <form action="{{route('frontend.orderStore')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                            <input type="hidden" name="order_detail" value="{{json_encode($orderJson)}}" />
                            <input type="hidden" name="total" value="{{$subtotal}}"> 
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    
    <script>
        $(document).ready(function() {
        
        });
    </script>
@endsection
