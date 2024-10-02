@extends('layouts.app')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl  py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Danh sách đơn hàng của bạn') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($orders->isEmpty())
                        <p>Bạn chưa có đơn hàng nào.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            @if ($order->payment_method == 'Cod')
                                                {{ $order->cod_id }}
                                            @else
                                                {{ $order->transaction_id }}
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ number_format($order->amount, 0, ',', '.') }} VND</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>
                                            <a href="{{ route('order.show', $order ->id )}}" class="btn btn-info"><i class="fas fa-eye" title="Chi tiết đơn hàng"></i> </a>
                                            <a href="{{ route('order.delete', $order->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash" title="Hủy đơn hàng"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
