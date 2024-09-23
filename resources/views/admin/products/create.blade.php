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
                <a href="{{ route('products.index') }}" class="btn btn-info">Back</a>
               <div class="containet m-3">
                <form method="POST" action="{{ route('products.store') }}"  enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Name:</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                  </div>
                  <div class="mb-3 mt-3">
                      <label for="quantity" class="form-label">Quantity:</label>
                      <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity" required>
                  </div>
                  <div class="mb-3">
                      <label for="price" class="form-label">Price:</label>
                      <input type="number" class="form-control" min="0" max="1000000000" step="0.01" id="price" placeholder="Enter Price" name="price" required>
                  </div>
                  <div class="mb-3">
                      <label for="image_path" class="form-label">Image:</label>
                      <input type="file" class="form-control" id="image_path" name="image_path" >
                  </div>
                  <div class="mb-3">
                      <label for="description" class="form-label">Description:</label>
                      <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
                  </div>
                  <button class="btn btn-success">Add Product</button>
              </form>
              
            </div>
        </div>
    </div>
@endsection
