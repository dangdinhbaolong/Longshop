@extends('layouts.app')

@section('header')
<header class="bg-white shadow">
    <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tạo mới đơn hàng') }}
        </h2>
    </div>
</header>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('order.store') }}" id="frmCreateOrder" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    
        <div class="mb-3">
            <label for="amount" class="form-label">Số tiền</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ Cart::subtotal(0, '', '') }}" readonly>
        </div>
    
        <!-- Payment Method Selection -->
        <div class="mb-3">
            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
            <select class="form-control" id="payment_method" name="payment_method">
                <option value="Cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="Momo">MoMo</option>
            </select>
        </div>
       <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Thông tin khách hàng') }}</h1>
        <div class="mb-3">
            <label for="" class="form-label">Tên khách hàng </label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Địa chỉ giao hàng</label>
            <input type="text" id="adress" name="adress" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control">
        </div>
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Thanh toán</button>
        <a href="{{ route('cart.show') }}" class="btn btn-danger">Hủy</a>
    </form>
</div>
@endsection
