@extends('layouts.app')

@section('header')
    <header class="bg-white shadow">
        <header class="bg-white shadow position-relative"> <!-- Add position-relative to the header -->
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h2  class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Chi tiết đơn hàng') }}
                </h2>
            </div>
        </header>

    </header>
@endsection
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="order-info col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Thông tin đơn hàng</h2>
                <p><strong>Mã đơn hàng:</strong>
                    @if ($order->payment_method == 'Cod')
                        {{ $order->cod_id }}
                    @else
                        {{ $order->transaction_id }}
                    @endif
                </p>
                <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Tình trạng thanh toán:</strong> {{ $order->payment_status }}</p>
                <p><strong>Tình trạng đơn hàng:</strong> {{ $order->status }}</p>
            </div>

            <div class="customer-info col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Thông tin khách hàng</h2>
                <p><strong>Tên khách hàng:</strong> {{ $order->name }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->adress }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            </div>
        </div>
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight " style="font-size: 1.5rem">Trạng thái đơn hàng</h2>
        </div>
        <hr class="m-4">
        <div class="items">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight " style="font-size: 1.5rem">Sản phẩm trong đơn hàng</h2>
            <table class="table m-2">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td><img src="{{ asset('images/products/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" width="100"></td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }} VND</td>
                            <td>{{ number_format($item->quantity * $item->price, 2) }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="order-total">
            <h2 class=" text-xl text-gray-800 leading-tight"><strong>Tổng giá:</strong> {{ number_format($order->amount, 2) }} VND</h2>
        </div>
    </div>
@endsection
