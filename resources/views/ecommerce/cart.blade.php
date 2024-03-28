@extends('layouts.app2')
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
                {{Route::current()->getName()}}
                
            </div>
        </div>
    </div>
</div>

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($cart as $carts)
                        <tr>
                            <td class="align-middle">
                                <img src="" alt="" style="width: 50px" />
                               {{$carts->product->name}}
                            </td>
                            <td class="align-middle" id="price_{{$carts->id}}">{{$carts->product->price}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" id="minus-btn_{{$carts->id}}">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                       id="quantity_{{$carts->id}}"  value="{{$carts->quantity}}" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus"id="plus-btn_{{$carts->id}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total_{{$carts->id}}">150</td>
                            <td class="align-middle">
                                <form action="{{ route('carts.destroy', ['cart' => $carts->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                                <form action="{{ route('carts.update', ['cart'=>$carts->id]) }}" method="post">
                                    @csrf
                                    @method ('PUT')
                                    <input type="hidden" name="quantity" id="quantitynew_{{$carts->id}}" value="{{$carts->quantity}}">
                                    <button type="submit" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Update Cart
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code" />
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"id="subtotal">$0</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold" >Total</h5>
                            <h5 class="font-weight-bold"id='totalamt'>$0</h5>
                        </div>
                        <a href="{{route('frontend.checkout',['detail'=>auth()->id()])}}" class="btn btn-block btn-primary my-3 py-3">
                            Proceed To Checkout
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    <script>
$(document).ready(function(){
    // var subtotal = 0; 
    $(document).on('click', '[id^="plus-btn_"]', function() {
        var cartId = $(this).attr('id').split('_')[1];
        var quantityInput = $('#quantity_' + cartId);
        var quantity = parseInt(quantityInput.val());
        var quantityForm =$('#quantitynew_' + cartId);
      console.log(quantityInput.val(quantity));
        quantityForm.val(quantity);
        
        updateTotalPrice(cartId);
    });

    // Delegate click event for minus button
    $(document).on('click', '[id^="minus-btn_"]', function() {
        var cartId = $(this).attr('id').split('_')[1];
        var quantityInput = $('#quantity_' + cartId);
        var quantity = parseInt(quantityInput.val());//taking the value
        var quantityForm =$('#quantitynew_' + cartId);
        quantityForm.val(quantity);
        if (quantity > 1) {
            quantityInput.val(quantity);
            updateTotalPrice(cartId);
        }
    });

    // Input event for quantity input
    $(document).on('input', '[id^="quantity_"]', function() {
        var cartId = $(this).attr('id').split('_')[1];
        var quantity = parseInt($(this).val());
        if (isNaN(quantity) || quantity < 1) {
            $(this).val(1);
            quantity = 1;
        }
        updateTotalPrice(cartId);
    });

    // Function to update the total price for a given row
    function updateTotalPrice(cartId) {
        var subtotal = 0; 
        var totalPrice =0
        var price = parseInt($('#price_' + cartId).text());
        var quantity = parseInt($('#quantity_' + cartId).val());
        var totalPrice = price * quantity;
        subtotal = (subtotal || 0) + totalPrice; // Ensure subtotal is initialized
        $('#total_' + cartId).text(totalPrice); 
        updateSubtotal(subtotal); // Update subtotal
     }
     function updateSubtotal(subtotal) {
        $('#subtotal').text('$' + subtotal);
        $('#totalamt').text('$' + subtotal);

    }

    // Initial update of total prices
    $('[id^="quantity_"]').each(function() {
        var cartId = $(this).attr('id').split('_')[1];
        updateTotalPrice(cartId);
    });
});
    </script>
@endsection
