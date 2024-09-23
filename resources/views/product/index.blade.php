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
                <sup class="text-success" style="font-size: 20px;">{{ Cart::count() }}</sup>
            </a>
        </div>
    </header>
    
</header>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="font-size: 30px">Sản phẩm</h1>
                <hr>
                <div class="list-product mt-3">
                    <div class="row">
                        @foreach ($products as $product )
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <div class="product-item border py-2">
                                <div class="product-thumb">
                                    <a href="">
                                        <img class="img-fluid mx-auto" src="{{ asset('images/products/' . $product->image_path) }}" alt="">
                                    </a>
                                </div>
                                <div class="product-info p-2 text-center">
                                    <a class="product-title" href="{{ route('product.show',$product->id) }}">{{ $product->name }}</a>
                                    <div class="price-box">
                                        <span class="current-price text-danger">{{number_format($product->price ,0,'','.')}}</span>
                                    </div>
                                    <a href="{{ route('cart.add', $product ->id) }}" class="btn btn-outline-danger btn-sm mt-3" class="add-to-cart">Thêm vào giỏ hàng</a>
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
