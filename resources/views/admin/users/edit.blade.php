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
                    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                name="name" value="{{ old('name', $users->name) }} "required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email"
                                name="email" value="{{ old('email', $users->email) }} " required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password"
                                name="password" value="{{ old('password', $users->password) }} " required>
                        </div>
                        <div class="mb-3">
                            <label for="usertype" class="form-label">UserType:</label>
                            <input type="usertype" class="form-control" id="usertype" placeholder="Enter usertype"
                                name="usertype" value="{{ old('usertype', $users->usertype) }} " required>
                        </div>
                        <button type="submit" class="btn btn-success">Update User</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
