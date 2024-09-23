<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.admin')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" class="form-control" min="0" max="1000000000" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_path" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="image_path" name="image_path">
                            @if($product->image_path)
                                <img src="{{ asset('images/products/' . $product->image_path) }}" alt="{{ $product->name }}" width="100px" class="mt-2">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Update Product</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
