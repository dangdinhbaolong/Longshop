@extends('layouts.admin')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('products.create') }}" class="btn btn-info">Add Product</a>
                <div class="p-6 text-gray-900">
                    @if ($products->isEmpty())
                        <p>Bạn chưa có sản phẩm nào.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><strong>{{ number_format($product->price, 0, '', '.') }} đ</strong></td>
                                        <td>{{ $product->quantity }}</td>
                                        <td><img src="{{ asset('images/products/' . $product->image_path) }}"
                                                alt="{{ $product->name }}" width="100px"></td>
                                        <td>{{ Str::limit($product->description, 50, '...') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i
                                                    class="fa-regular fa-pen-to-square" title="Sửa"></i></a>
                                            <a href="{{ route('products.destroy', $product->id) }}"
                                                class="btn btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();">
                                                <i class="fa-solid fa-trash" title="Xóa"></i>
                                            </a>
                                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
