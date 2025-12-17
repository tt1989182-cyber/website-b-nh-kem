<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Instagram') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --ig-primary: #262626;
            --ig-secondary: #8e8e8e;
            --ig-border: #dbdbdb;
            --ig-link: #0095f6;
            --ig-bg: #fafafa;
        }
        
        body {
            background-color: var(--ig-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: var(--ig-primary);
        }
        
        /* Navbar giống Instagram */
        .navbar-instagram {
            background-color: white !important;
            border-bottom: 1px solid var(--ig-border);
            height: 60px;
            padding: 0;
        }
        
        .navbar-instagram .container {
            max-width: 975px;
            height: 100%;
        }
        
        .navbar-brand {
            font-family: 'Instagram', cursive;
            font-size: 24px;
            font-weight: 300;
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 5px;
        }
        
        /* Tìm kiếm giống Instagram */
        .search-box {
            width: 215px;
            height: 28px;
            background-color: var(--ig-bg);
            border: 1px solid var(--ig-border);
            border-radius: 3px;
            font-size: 14px;
            color: var(--ig-secondary);
            padding: 3px 10px 3px 26px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238e8e8e' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 10px center;
        }
        
        .search-box:focus {
            outline: none;
            color: var(--ig-primary);
        }
        
        /* Navigation icons */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 22px;
        }
        
        .nav-icon {
            font-size: 22px;
            color: var(--ig-primary);
            position: relative;
            text-decoration: none;
        }
        
        .nav-icon:hover {
            color: var(--ig-primary);
        }
        
        .profile-pic-nav {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--ig-border);
        }
        
        /* Main content */
        .main-content {
            max-width: 975px;
            margin: 30px auto 0;
            padding: 0 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .search-box {
                display: none;
            }
            
            .main-content {
                padding: 0 10px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-instagram {
                height: 54px;
            }
            
            .navbar-brand {
                font-size: 22px;
            }
        }
        
        /* Custom buttons */
        .btn-instagram {
            background-color: var(--ig-link);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 9px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .btn-instagram:hover {
            background-color: #0081d6;
            color: white;
        }
        
        /* Dropdown menu */
        .dropdown-menu {
            border: 1px solid var(--ig-border);
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
            border-radius: 6px;
        }
        
        .dropdown-item {
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-divider {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-instagram shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Instagram
                </a>
                
                <!-- Thanh tìm kiếm (chỉ hiển thị trên màn hình vừa và lớn) -->
                <div class="d-none d-md-block">
                    <input type="text" class="search-box" placeholder="Tìm kiếm">
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Menu bên phải -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-instagram" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="nav-icons">
                                <a class="nav-icon" href="{{ route('posts.index') }}" title="Trang chủ">
                                    <i class="fa fa-home"></i>
                                </a>
                                
                                <a class="nav-icon" href="#" title="Tin nhắn">
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                                
                                <a class="nav-icon" href="{{ route('posts.create') }}" title="Tạo mới">
                                    <i class="fa fa-plus-square"></i>
                                </a>
                                
                                <a class="nav-icon" href="#" title="Khám phá">
                                    <i class="fa fa-compass"></i>
                                </a>
                                
                                <a class="nav-icon" href="#" title="Thông báo">
                                    <i class="fa fa-heart"></i>
                                </a>
                                
                                <li class="nav-item dropdown" style="list-style: none;">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @if(Auth::user()->profile_picture)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="profile-pic-nav" alt="{{ Auth::user()->username }}">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=random&color=fff" class="profile-pic-nav" alt="{{ Auth::user()->username }}">
                                        @endif
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                            <i class="fa fa-user me-2"></i> Hồ sơ
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-bookmark me-2"></i> Đã lưu
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-cog me-2"></i> Cài đặt
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out-alt me-2"></i> Đăng xuất
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content py-4">
            @yield('content')
        </main>
        
        <!-- Footer (tùy chọn, giống Instagram) -->
        @if(Request::is('/') || Request::is('posts') || Request::is('posts/*'))
        <footer class="mt-5 py-4 border-top">
            <div class="container text-center">
                <div class="mb-3">
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Meta</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Giới thiệu</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Blog</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Việc làm</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Trợ giúp</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">API</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Quyền riêng tư</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Điều khoản</a>
                    <a href="#" class="text-decoration-none text-secondary me-3" style="font-size: 12px;">Vị trí</a>
                </div>
                <div class="text-secondary" style="font-size: 12px;">
                    Tiếng Việt © {{ date('Y') }} Instagram từ Meta
                </div>
            </div>
        </footer>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>