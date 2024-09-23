@extends('layouts.app')

@section('header')
<header class="bg-white shadow position-relative">
    <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>
    
    <!-- Shopping cart icon -->
    <div class="position-absolute bottom-0 end-0 p-3">
        <a href="{{ route('cart.show') }}" class="py-2 d-block btn text-danger">
            <i class="fa-solid fa-cart-shopping m-1" style="font-size: 24px;"></i>
            <sup class="text-success" style="font-size: 20px;">{{ Cart::count() }}</sup>
        </a>
    </div>
</header>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('cart.update') }}" method="POST"> <!-- Update cart action -->
                @csrf 
                @if (Cart::count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $row)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>
                               
                                <img src="{{ asset('images/products/'  .$row->options->image_path) }}" width="100px" alt="">
                            </td>
                            <td><a href="#">{{ $row->name }}</a></td>
                            <td>{{ number_format($row->price, 0, '', '.') }} đ</td>
                            <td>
                                <input type="number" min="1" name="qty[{{ $row->rowId }}]" style="width:80px; text-align: center" value="{{ $row->qty }}">
                            </td>
                            <td>{{ number_format($row->subtotal, 0, '', '.') }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $row->rowId) }}" class=" btn btn-danger">Xóa</a> <!-- Remove item link -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='6' class="text-right">Tổng:</td>
                            @php
                                $subtotal = (float) str_replace(',', '', Cart::subtotal());
                            @endphp
                            <td><strong>{{ number_format($subtotal, 0, '', '.') }}</strong></td>

                        </tr>
                    </tfoot>
                </table>
                <a href="{{ route('dashboard') }} " class="btn btn-dark text-white">Back to home</a>
                <input type="submit" class="btn btn-dark" value="Cập nhật giỏ hàng">
                <a href="{{ route('cart.destroy') }}" class="btn btn-danger">Xóa toàn bộ giỏ hàng</a>
                @else
                <p>Giỏ hàng của bạn đang trống.</p>
                @endif  
            </form>
            <div class="position-absolute end-0 p-2 ">
                <a href="{{ route('order.create') }}" class="py-2 d-block btn btn-success m-3">
                    Thanh toán <i class="fa-solid fa-right-long"></i>
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection
