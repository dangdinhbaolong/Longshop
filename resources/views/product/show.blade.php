@extends('layouts.app')

@section('header')
<header class="bg-white shadow">
    <header class="bg-white shadow position-relative"> <!-- Add position-relative to the header -->
        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product') }}
            </h2>
        </div>
        
        <!-- Shopping cart icon -->
        <div class="position-absolute bottom-0 end-0 p-3"> <!-- Added padding for better spacing -->
            <a href="{{ url('cart/show') }}" class="py-2 d-block btn text-danger">
                <i class="fa-solid fa-cart-shopping m-1" style="font-size: 24px;"></i>
                <sup class="text-success" style="font-size: 20px;">0</sup>
            </a>
        </div>
    </header>
    
</header>
@endsection
@section('content')
    <style>
        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .quantity-controls_sub,
        .quantity-controls_add {
            width: 40px;
            height: 40px;
        }

        .quantity-controls input {
            width: 60px;
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="font-size: 30px">Sản phẩm</h1>
                <hr>
                <div class="list-product mt-3">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column align-items-center">
                            <!-- Main Product Image -->
                            <div class="detail-img mb-3">
                                <img id="main-image" src="{{ asset('images/products/' . $product->image_path) }}"
                                    class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;"
                                    alt="Laptop Dell Latitude 7400">
                            </div>
                            <!-- List of Images -->
                            {{-- <div class="detail-img_list d-flex flex-wrap justify-content-center">
                                <img src="./public/img/7.png" class="img-thumbnail m-1" alt="Image 1"
                                    onclick="changeImage('./public/img/7.png')">
                                <img src="./public/img/2.png" class="img-thumbnail m-1" alt="Image 1"
                                    onclick="changeImage('./public/img/2.png')">
                                <img src="./public/img/3.png" class="img-thumbnail m-1" alt="Image 2"
                                    onclick="changeImage('./public/img/3.png')">
                                <img src="./public/img/4.png" class="img-thumbnail m-1" alt="Image 3"
                                    onclick="changeImage('./public/img/4.png')">
                                <img src="./public/img/5.png" class="img-thumbnail m-1" alt="Image 4"
                                    onclick="changeImage('./public/img/5.png')">
                                <img src="./public/img/6.png" class="img-thumbnail m-1" alt="Image 5"
                                    onclick="changeImage('./public/img/6.png')">
                            </div> --}}
                        </div>
                        <!-- Product Info -->
                        <div class="col-md-6">
                            <div class="detail-info">
                                <h3 class="h4">{{ $product->name }}</h3>
                                <p>Core i5-8365U (i7-8265U) / RAM 16GB / SSD 256GB / Màn 14.0 inch FHD 1920x1080 IPS</p>
                                <p>Sản phẩm :
                                    <?php 
                                    if ($product->quantity == 0) { ?>
                                    <span class="text-danger font-weight-bold ">Hết hàng</span>
                                    <?php } else { ?>
                                    <span class="text-success font-weight-bold">Còn hàng</span>
                                    <?php } ?>
                                </p>

                                <p class="h5">{{ number_format($product->price, 0, '', '.') }}</p>
                                <div class="quantity-controls d-flex align-items-center mt-3">
                                    <button id="decrease-quantity"
                                        class="quantity-controls_sub btn btn-outline-secondary">-</button>
                                    <input type="text" id="quantity" value="1" readonly class="form-control mx-2">
                                    <button id="increase-quantity"
                                        class="quantity-controls_add btn btn-outline-secondary">+</button>
                                    <button id="add-to-cart" class="btn btn-danger mx-2 text-white">Thêm vào giỏ
                                        hàng</button>
                                </div>
                            </div>
                        </div>
                        <div class="dicript">
                            <h2>Mô tả sản phẩm</h2>
                            <hr>
                            <p>
                                {{ $product->description }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
