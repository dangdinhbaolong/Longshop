@extends('layouts.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6"> <!-- Adjust the width of the card -->
            <div class="card p-2">
                <div class="card-body m-2">
                    <style>
                        .check-icon svg {
                            color: #28a745;
                            /* Custom green */
                        }
                    </style>

                    <div class="check-icon mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="50" fill="currentColor"
                            class="bi bi-check-circle mx-auto" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z" />
                            <path
                                d="M10.97 6.97a.75.75 0 0 1 1.07 1.05l-3.5 4a.75.75 0 0 1-1.08 0l-1.5-1.5a.75.75 0 1 1 1.08-1.06l1.03 1.02 3.42-3.91z" />
                        </svg>
                    </div>

                    <h3 class="card-title text-success text-center">Đặt hàng thành công!</h3>
                    <p class="card-text text-center">Trong vòng 30 phút Shop sẽ liên hệ xác nhận thông tin giao hàng cho quý
                        khách.</p>

                    <div class="row mb-3 mt-2">
                        <div class="col-md-6">
                            <strong>Hình thức thanh toán: {{ $order->payment_method }}</strong>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Địa chỉ nhận hàng: {{ $order->adress }} </strong>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Số điện thoại: {{ $order->phone }} </strong>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Số tiền: {{ number_format($order->amount, 0, ',', '.') }} VND</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Mã giao dịch:
                                @if ($order->payment_method == 'Cod')
                                   
                                    {{ $order->cod_id }}
                
                                @else
                                    {{ $order->transaction_id }}
                                @endif
                            </strong>
                        </div>
                    </div>
                    <div class="text-center"><a href="{{ route('dashboard') }}" class=" btn btn-danger">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
