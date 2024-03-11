@extends('layouts.app')
@section('style')
    <style>
        .thumb-wrapper {
            padding: 25px 15px;
            background: #fff;
            border-radius: 6px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
        }

        .wish-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 99;
            cursor: pointer;
            font-size: 16px;
            color: #abb0b8;
        }
    </style>
@endsection
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://placekitten.com/1111/500" class="d-block w-100" alt="..." style="height: 100%;">
            </div>
            <div class="carousel-item">
                <img src="https://placekitten.com/1111/500" class="d-block w-100" alt="..." style="height: 100%;">
            </div>
            <div class="carousel-item">
                <img src="https://placekitten.com/1111/500" class="d-block w-100" alt="..." style="height: 100%;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- <div class="container mb-5" style="">
        <div class="row"> --}}
    <!---showing product-->
    <div class="d-flex justify-content-between mx-3">
        <div class="text-left mt-5 mb-2 ">
            <h4>Product Based on category</h4>
        </div>
        <div class="text-right mt-5 mb-2 ">
            <h4><a href="{{ route('frontend.index') }}">>>>View More</a></h4>
        </div>
    </div>

    <div class="col  p-5 d-flex mx-3" style="border-style: inset;">
        @foreach ($category as $categories)
            <div class="col-md-2 d-flex  justify-content-center">
                {{ $categories->category_name }}
            </div>
        @endforeach
    </div>
    <div class="text-left mt-5 mb-2 px-2">
        <h3>Offers just for you</h3>
    </div>
    <div class="d-flex justify-content-start mx-5 ">

        <div class=" d-flex p-3">
            <img src="https://placekitten.com/600/200" class="img-fluid banner-img " alt="new img" height="200"
                width="600">
        </div>
        <div class=" d-flex p-3 ">
            <img src="https://placekitten.com/400/200" class="img-fluid banner-img border-rounded" alt="new img"
                height="200" width="630">
        </div>
    </div>
    <div class="d-flex justify-content-between mx-3">

        <div class="text-left mt-5 mb-2 px-2">
            <h3>Product to your liking </h3>
        </div>
        <div class="text-right mt-5 mb-2 ">
            <h4><a href="{{ route('frontend.index') }}">>>>View More</a></h4>
        </div>
    </div>

    <div class="mb-5 p-5 d-flex justify-content" style="border-style: inset; ">
        <div class="col-md-2 mx-2" style="border-style: inset;">
            <div class="thumb-wrapper">

                <span class="wish-icon"><a href="#"><i class="fa-regular fa-heart"></a></i>
                    </i></span>
                <div class="img-box">
                    <img src="https://placekitten.com/400/200" class="img-fluid" alt="image">
                </div>
            </div>
            <div class="thumb-content">
                <h4>Car</h4>
                <p class="item-price"> <span>$418.00</span></p>
                {{-- <strike>$450.00</strike> --}}
                <div>
                    <small>category</small>
                </div>
                <a href="#" class="btn btn-primary btn-sm"  >Add to Cart</a>
            </div>
        </div>
        <div class="col-md-2 mx-2" style="border-style: inset;">
            <div class="thumb-wrapper">

                <span class="wish-icon"><a href="#"><i class="fa-regular fa-heart"></a></i>
                    </i></span>
                <div class="img-box">
                    <img src="https://placekitten.com/400/200" class="img-fluid" alt="image">
                </div>
            </div>
            <div class="thumb-content">
                <h4>Car</h4>
                <p class="item-price"> <span>$418.00</span></p>
                {{-- <strike>$450.00</strike> --}}
                <div>
                    <small>category</small>
                </div>
                <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
            </div>
        </div>
        <div class="col-md-2 mx-2" style="border-style: inset;">
            <div class="thumb-wrapper">

                <span class="wish-icon"><a href="#"><i class="fa-regular fa-heart"></a></i>
                    </i></span>
                <div class="img-box">
                    <img src="https://placekitten.com/400/200" class="img-fluid" alt="image">
                </div>
            </div>
            <div class="thumb-content">
                <h4>Car</h4>
                <p class="item-price"> <span>$418.00</span></p>
                {{-- <strike>$450.00</strike> --}}
                <div>
                    <small>category</small>
                </div>
                <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
            </div>
        </div>
        <div class="col-md-2 mx-2" style="border-style: inset;">
            <div class="thumb-wrapper">

                <span class="wish-icon"><a href="#"><i class="fa-regular fa-heart"></a></i>
                    </i></span>
                <div class="img-box">
                    <img src="https://placekitten.com/400/200" class="img-fluid" alt="image">
                </div>
            </div>
            <div class="thumb-content">
                <h4>Car</h4>
                <p class="item-price"> <span>$418.00</span></p>
                {{-- <strike>$450.00</strike> --}}
                <div>
                    <small>category</small>
                </div>
                <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
            </div>
        </div>
        <div class="col-md-2 mx-2" style="border-style: inset;">
            <div class="thumb-wrapper">

                <span class="wish-icon"><a href="#"><i class="fa-regular fa-heart"></a></i>
                    </i></span>
                <div class="img-box">
                    <img src="https://placekitten.com/400/200" class="img-fluid" alt="img">
                </div>
            </div>
            <div class="thumb-content">
                <h4>Car</h4>
                <p class="item-price"> <span>$418.00</span></p>
                {{-- <strike>$450.00</strike> --}}
                <div>
                    <small>category</small>
                </div>
                <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
            </div>
        </div>


    </div>



    {{-- </div>
    </div> --}}
@endsection
