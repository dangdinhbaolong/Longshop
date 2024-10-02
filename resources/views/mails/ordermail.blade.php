<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7sAc7ba5ilTGYFkLW6Rt4ZVo9P6t8KwC+4" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- Email Header -->
        <table class="table table-borderless">
            <tr>
                <td class="text-center">
                    <img src="https://ci3.googleusercontent.com/meips/ADKq_NZeQ-9ttJt5qhDEfFUUJY3w5IQwEwT5sxCCMEf1U0zAdp8tXCS_iaSOWjPSU541ndfBKkR2VUUxcRfbDeQoVKanMAZweqddb-aY-29A8Cep=s0-d-e1-ft#https://cf.shopee.sg/file/0cd023d64f04491f3dc8076d6932dfdc"
                         width="140" height="auto" class="img-fluid">
                </td>
            </tr>
        </table>

        <!-- Divider -->
        <div class="text-center my-2">
            <hr>
        </div>

        <!-- Order Information Section -->
        <h5 class="text-left">THÔNG TIN ĐƠN HÀNG - DÀNH CHO NGƯỜI MUA</h5>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>Mã đơn hàng:</td>
                    <td>
                        @if ($order->payment_method == 'Cod') 
                            {{ $order->cod_id }}
                        @else 
                            {{ $order->transaction_id }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Ngày đặt hàng:</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Order Items Section -->
        <h6>Chi tiết sản phẩm:</h6>
        <table class="table">
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>
                        <a href="https://shopee.vn/universal-link/M%C5%A9+l%C6%B0%E1%BB%A1i+trai+cruise+nhi%E1%BB%81u+m%C3%A0u%2C+n%C3%B3n+k%E1%BA%BFt+form+unisex+nam+n%E1%BB%AF+-+MK03-i.791633743.17874071488/?smtt=580.490845029.7"
                            target="_blank">
                            <img src="{{ asset('images/products/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" 
                                 class="img-fluid" style="max-width: 140px;">

                    </td>
                    <td>
                        <p>{{ $item->product->name }}</p>
                        <p>Số lượng: {{ $item->quantity }}</p>
                        <p>Giá: {{ number_format($item->price, 0) }} VND</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <table class="table">
            <tr>
                <td>Tổng tiền:</td>
                <td>{{ $order->amount }} VND</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="text-center mt-3">
            <p class="text-muted" style="font-size: 11px;">
                Đây là email tự động. Vui lòng không trả lời email này. Thêm 
                <a href="mailto:info@mail.shopee.vn" class="text-decoration-none text-danger">info@mail.shopee.vn</a> 
                vào danh bạ email của bạn để đảm bảo bạn luôn nhận được email từ chúng tôi.
            </p>
            <p>
                <a href="https://shopee.vn/docs/3603" class="text-decoration-none text-danger">Chính sách bảo mật</a> |
                <a href="https://shopee.vn/legaldoc/policies/" class="text-decoration-none text-danger">Điều khoản Shopee</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Wd99b3hf2dfsgfbdV+fEnJX1HeE9D5jFQzlxvl/jbkv3em39pup1mWly3+4Rsg+" crossorigin="anonymous"></script>
</body>

</html>
