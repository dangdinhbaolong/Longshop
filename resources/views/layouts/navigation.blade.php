<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="container-fluid">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('admin.dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <!-- Hamburger Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links and Dropdown Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Navigation Links -->
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">{{ __('Trang chủ') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('Sản phẩm') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">{{ __('Đơn mua') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('introduce') }}">{{ __('Giới thiệu') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Liên hệ') }}</a>
                </li>
            </ul>
            <!-- User Dropdown Menu -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('order.index') }}">{{ __('Đơn mua') }}</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        
                            <a href="{{ route('logout') }}" 
                               class="dropdown-item" 
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
