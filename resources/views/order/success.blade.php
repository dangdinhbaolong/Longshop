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
                        <img class="img-fluid m-auto " src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/checkout/tiki-mascot-congrat.svg"
                        width="150" height="150" alt="icon">
                    </div>

                    <h3 class="card-title text-success text-center " style="font-size: 25px">Yeah!!  Bạn đã đặt hàng thành công!</h3>
                    <p class="card-text text-center">Trong vòng 30 phút Shop sẽ liên hệ xác nhận thông tin giao hàng cho quý
                        khách.</p>

                    <div class="row mb-3 mt-2">
                        <div class="col-md-6">
                            <strong>Phương thức thanh toán: {{ $order->payment_method }}</strong>

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
                            <strong>Tổng tiền: {{ number_format($order->amount, 0, ',', '.') }} VND</strong>
                        </div>
                    </div>
                    <div class="text-center"><a href="{{ route('dashboard') }}" class=" btn btn-danger">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
