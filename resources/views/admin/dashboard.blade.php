@extends('layouts.admin')

@section('header')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </div>
</header>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container-fluid py-5">
                    <div class="row">
                        <div class="col">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalOrderComplete }}</h5>
                                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">CHỜ XỬ LÝ</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalOrderPending }}</h5>
                                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">DOANH SỐ</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ number_format($totalOrder) }}</h5>
                                    <p class="card-text">Doanh số hệ thống</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header">ĐƠN HÀNG HỦY</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalOrderCancel }}</h5>
                                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="card mt-4">
                        <div class="card-header font-weight-bold">
                            Biểu Đồ Đơn Hàng
                        </div>
                        <div class="card-body">
                            <canvas id="ordersChart" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <!-- New Orders Section -->
                    <div class="card mt-4">
                        <div class="card-header font-weight-bold">
                            ĐƠN HÀNG MỚI
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá trị</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Không có đơn hàng nào.</td>
                                        </tr>
                                    @else
                                        @foreach ($orders as $order)
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        @if ($order->payment_method == 'Cod')
                                                            {{ $order->cod_id }}
                                                        @else
                                                            {{ $order->transaction_id }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->price) }}đ</td>
                                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ number_format($order->amount, 0, ',', '.') }}đ</td>
                                                    <td>
                                                    @if ($order->status == 'Đang xử lý')
                                        <p  class="btn btn-info">{{ $order->status }}</p></td>
                                        @elseif ($order->status == 'Đã giao thành công')
                                        <p  class="btn btn-success">{{ $order->status }}</p></td>
                                        @elseif ($order->status == 'Đang giao hàng')
                                        <p  class="btn btn-primary">{{ $order->status }}</p></td>
                                        @elseif ($order->status == 'Bị hủy')
                                        <p  class="btn btn-danger">{{ $order->status }}</p></td>
                                        @else
                                        <p  class="btn btn-secondary">{{ $order->status }}</p></td>
                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($ordersData['labels']), // Dynamic labels
            datasets: [
                {
                    label: 'Chờ xử lý',
                    data: @json($ordersData['data'][0]), // Pending data
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Đã giao thành công',
                    data: @json($ordersData['data'][1]), // Completed data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Bị hủy',
                    data: @json($ordersData['data'][2]), // Canceled data
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số lượng đơn hàng'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Ngày'
                    }
                }
            }
        }
    });
</script>

@endsection
