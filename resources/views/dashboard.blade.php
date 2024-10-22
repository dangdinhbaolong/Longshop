@extends('layouts.app')

@section('header')
    <header class="bg-white shadow position-relative"> <!-- Add position-relative to the header -->
        <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>

        <!-- Shopping cart icon -->
        <div class="position-absolute bottom-0 end-0 p-3"> <!-- Added padding for better spacing -->
            <a href="{{ url('cart/show') }}" class="py-2 d-block btn text-danger">
                <i class="fa-solid fa-cart-shopping m-1" style="font-size: 24px;"></i>
                <sup class="text-success" style="font-size: 20px;">{{ Cart::count() }}</sup>
            </a>
        </div>
    </header>
@endsection

@section('banner')
    <div class="m-3">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://thudaumot.edu.vn/wp-content/uploads/2021/04/Banner-quang-cao-may-tinh-3.jpg"
                        alt="Los Angeles" class="d-block" style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="https://thudaumot.edu.vn/wp-content/uploads/2021/04/Banner-quang-cao-may-tinh-3.jpg"
                        alt="Chicago" class="d-block" style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="https://thudaumot.edu.vn/wp-content/uploads/2021/04/Banner-quang-cao-may-tinh-3.jpg"
                        alt="New York" class="d-block" style="width:100%">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

    </div>
    <div class="note d-flex justify-content-around m-3">
        <div class="text-center">
            <img src="../images/list/fship.png" class="img-fluid mx-auto" alt="">
            <h5>Miễn phí vận chuyển</h5>
            <p>Tới tận tay khách hàng</p>
        </div>
        <div class="text-center">
            <img src="../images/list/tuvan.png" class="img-fluid mx-auto" alt="">
            <h5>Tư vấn 24/7</h5>
            <p>01122233343</p>
        </div>
        <div class="text-center">
            <img src="../images/list/save.png" class="img-fluid mx-auto" alt="">
            <h5>Tiết kiệm hơn</h5>
            <p>Với ưu đãi thật lớn</p>
        </div>
        <div class="text-center">
            <img src="../images/list/pay.png" class="img-fluid mx-auto" alt="">
            <h5>Thanh toán nhanh</h5>
            <p>Hỗ trợ nhiều hình thức</p>
        </div>
        <div class="text-center">
            <img src="../images/list/order.png" class="img-fluid mx-auto" alt="">
            <h5>Đặt hàng online</h5>
            <p>Thao tác đơn giản</p>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="font-size: 30px">Sản phẩm bán chạy</h1>
                <hr>
                <div class="list-product mt-3">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="product-item border py-2">
                                    <div class="product-thumb">
                                        <a href="">
                                            <img class="img-fluid mx-auto"
                                                src="{{ asset('images/products/' . $product->image_path) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-info p-2 text-center">
                                        <a class="product-title" href="">{{ $product->name }}</a>
                                        <div class="price-box">
                                            <span
                                                class="current-price text-danger">{{ number_format($product->price, 0, '', '.') }}đ</span>
                                        </div>
                                        <a href="{{ route('cart.add', $product->id) }}"
                                            class="btn btn-outline-danger btn-sm mt-3" class="add-to-cart">Thêm vào giỏ
                                            hàng</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
