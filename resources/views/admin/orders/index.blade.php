@extends('layouts.admin')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Orders') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order )
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->amount }}</td>
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
                                    <td>{{ $order->created_at}}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('orders.show',$order->id) }}" class="btn btn-info"><i class="fas fa-eye" title="Chi tiết đơn hàng"></i> </a>
                                        <a href="" class="btn btn-danger"><i class="fa-solid fa-trash" title="Xóa đơn hàng"></i></a>
                                    </td>
                                    
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
