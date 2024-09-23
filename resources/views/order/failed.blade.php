@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-5"> <!-- Adjust the width of the card -->
        <div class="card text-center">
            <div class="card-body m-2">
                <style>
                    .error-icon svg {
                        color: #dc3545; /* Custom red */
                    }
                </style>
                
                <div class="error-icon mb-3 m-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-x-circle mx-auto" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z"/>
                        <path d="M4.293 4.293a1 1 0 0 1 1.414 0L8 5.586l2.293-2.293a1 1 0 1 1 1.414 1.414L9.414 7l2.293 2.293a1 1 0 0 1-1.414 1.414L8 8.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 0-1.414z"/>
                    </svg>
                </div>
                
                <h3 class="card-title text-danger">Đặt hàng thất bại!</h3>
                <p class="card-text">Có lỗi xảy ra khi đặt hàng.<br> Vui lòng thử lại hoặc liên hệ với chúng tôi để biết thêm thông tin.</p>
                
                <a href="{{ route('dashboard') }}" class=" mt-2 btn btn-primary">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
@endsection
