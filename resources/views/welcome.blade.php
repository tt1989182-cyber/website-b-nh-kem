@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Left Column - Login/Register Forms -->
        <div class="col-md-4 d-none d-md-block">
            <div class="position-fixed" style="width: 350px;">
                @guest
                    <!-- Login Form -->
                    <div class="instagram-card mb-4">
                        <h2 class="text-center mb-4 instagram-logo">
                            <i class="fab fa-instagram me-2"></i>Instagram
                        </h2>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" 
                                       class="form-control instagram-search" 
                                       placeholder="Tên người dùng, email hoặc số điện thoại"
                                       name="email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" 
                                       class="form-control instagram-search" 
                                       placeholder="Mật khẩu"
                                       name="password" required>
                            </div>
                            <button type="submit" class="instagram-btn mb-3">
                                Đăng nhập
                            </button>
                        </form>
                        
                        <div class="divider">HOẶC</div>
                        
                        <!-- Facebook Login -->
                        <button class="btn btn-outline-primary w-100 mb-3" style="border-color: #1877f2;">
                            <i class="fab fa-facebook-square me-2"></i>
                            Đăng nhập bằng Facebook
                        </button>
                        
                        <div class="text-center">
                            <a href="#" class="text-decoration-none" style="color: #00376b; font-size: 12px;">
                                Quên mật khẩu?
                            </a>
                        </div>
                    </div>
                    
                    <!-- Register Card -->
                    <div class="instagram-card">
                        <p class="text-center mb-3">
                            Chưa có tài khoản? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--ig-blue);">
                                Đăng ký
                            </a>
                        </p>
                    </div>
                    
                    <!-- Download App -->
                    <div class="text-center mt-4">
                        <p>Tải ứng dụng.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#">
                                <img src="https://static.cdninstagram.com/rsrc.php/v3/yz/r/c5Rp7Ym-Klz.png" 
                                     alt="App Store" style="height: 40px;">
                            </a>
                            <a href="#">
                                <img src="https://static.cdninstagram.com/rsrc.php/v3/yu/r/EHY6QnZYdNX.png" 
                                     alt="Google Play" style="height: 40px;">
                            </a>
                        </div>
                    </div>
                @else
                    <!-- User is logged in - Show Stories -->
                    <div class="instagram-card">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=random" 
                                 class="profile-pic me-3" style="width: 56px; height: 56px;">
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                                <small class="text-secondary">{{ Auth::user()->name ?? 'Người dùng Instagram' }}</small>
                            </div>
                        </div>
                        
                        <!-- Stories Section -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-secondary">Tin</h6>
                                <a href="#" class="text-decoration-none" style="color: var(--ig-primary); font-size: 12px;">
                                    Xem tất cả
                                </a>
                            </div>
                            <div class="d-flex gap-3 overflow-auto">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="text-center">
                                        <div class="position-relative mb-1">
                                            <img src="https://randomuser.me/api/portraits/women/{{ $i }}.jpg" 
                                                 class="rounded-circle border border-3 border-primary" 
                                                 style="width: 56px; height: 56px; object-fit: cover;">
                                        </div>
                                        <small class="text-secondary">user{{ $i }}</small>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        
                        <!-- Suggestions -->
                        <div><div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-secondary">Gợi ý cho bạn</h6>
                                <a href="#" class="text-decoration-none" style="color: var(--ig-primary); font-size: 12px;">
                                    Xem tất cả
                                </a>
                            </div>
                            @for($i = 1; $i <= 3; $i++)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://randomuser.me/api/portraits/men/{{ $i }}.jpg" 
                                             class="profile-pic me-2" style="width: 32px; height: 32px;">
                                        <div>
                                            <small class="d-block">suggested_user{{ $i }}</small>
                                            <small class="text-secondary">Gợi ý cho bạn</small>
                                        </div>
                                    </div>
                                    <a href="#" class="text-decoration-none" style="color: var(--ig-blue); font-size: 12px;">
                                        Theo dõi
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endguest
            </div>
        </div>
        
        <!-- Right Column - Posts Feed -->
        <div class="col-md-8 col-lg-7 col-xl-6">
            @auth
                <!-- Create Post -->
                <div class="instagram-card mb-4">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=random" 
                             class="profile-pic me-3">
                        <button class="flex-grow-1 text-start instagram-search" 
                                onclick="window.location='{{ route('posts.create') }}'">
                            Bạn đang nghĩ gì, {{ Auth::user()->username }}?
                        </button>
                    </div>
                    <div class="d-flex justify-content-around mt-3">
                        <button class="btn btn-sm">
                            <i class="fas fa-video text-danger me-1"></i>
                            <span class="text-secondary">Video trực tiếp</span>
                        </button>
                        <button class="btn btn-sm">
                            <i class="fas fa-images text-success me-1"></i>
                            <span class="text-secondary">Ảnh/video</span>
                        </button>
                        <button class="btn btn-sm">
                            <i class="far fa-smile text-warning me-1"></i>
                            <span class="text-secondary">Cảm xúc/Hoạt động</span>
                        </button>
                    </div>
                </div>
                
                <!-- Posts Feed -->
                <div id="posts-feed">
                    <!-- Sample Post 1 -->
                    <div class="instagram-card mb-4">
                        <!-- Post Header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/women/1.jpg" 
                                     class="profile-pic me-3" style="width: 32px; height: 32px;">
                                <div>
                                    <h6 class="mb-0">jennifer_doe</h6>
                                    <small class="text-secondary">Tokyo, Nhật Bản</small>
                                </div>
                            </div>
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </div>
                        
                        <!-- Post Image -->
                        <div class="mb-3">
                            <img src="https://images.unsplash.com/photo-1682685797366-715d29e33f9d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                 class="img-fluid w-100 rounded" 
                                 style="aspect-ratio: 1/1; object-fit: cover;">
                        </div>
                        
                        <!-- Post Actions -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex gap-3">
                                <i class="far fa-heart fa-lg" style="cursor: pointer;"></i>
                                <i class="far fa-comment fa-lg" style="cursor: pointer;"></i>
                                <i class="far fa-paper-plane fa-lg" style="cursor: pointer;"></i>
                            </div>
                            <i class="far fa-bookmark fa-lg" style="cursor: pointer;"></i>
                        </div>
                        
                        <!-- Post Likes -->
                        <div class="mb-2">
                            <strong>12,345 lượt thích</strong>
                        </div>
                        
                        <!-- Post Caption -->
                        <div class="mb-3">
                            <strong>jennifer_doe</strong> Chuyến đi tuyệt vời tại Tokyo! 🗼 #travel #japan #tokyo
                        </div>
                        
                        <!-- Post Comments -->
                        <div class="mb-3">
                            <div class="text-secondary mb-1">Xem tất cả 245 bình luận</div>
<div class="d-flex mb-2">
                                <strong>john_smith</strong>
                                <span class="ms-2">Thật đẹp! Tôi muốn đến đó quá 😍</span>
                            </div>
                            <div class="d-flex">
                                <strong>travel_lover</strong>
                                <span class="ms-2">Địa điểm này ở đâu vậy?</span>
                            </div>
                        </div>
                        
                        <!-- Post Time -->
                        <div class="text-secondary" style="font-size: 10px;">
                            3 GIỜ TRƯỚC
                        </div>
                    </div>
                    
                    <!-- Sample Post 2 -->
                    <div class="instagram-card mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/men/2.jpg" 
                                     class="profile-pic me-3" style="width: 32px; height: 32px;">
                                <div>
                                    <h6 class="mb-0">photographer_james</h6>
                                    <small class="text-secondary">Chuyên gia nhiếp ảnh</small>
                                </div>
                            </div>
                            <i class="fas fa-ellipsis-h text-secondary"></i>
                        </div>
                        
                        <div class="mb-3">
                            <img src="https://images.unsplash.com/photo-1682687220063-4742bd7fd538?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                                 class="img-fluid w-100 rounded" 
                                 style="aspect-ratio: 1/1; object-fit: cover;">
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div class="d-flex gap-3">
                                <i class="far fa-heart fa-lg" style="cursor: pointer;"></i>
                                <i class="far fa-comment fa-lg" style="cursor: pointer;"></i>
                                <i class="far fa-paper-plane fa-lg" style="cursor: pointer;"></i>
                            </div>
                            <i class="far fa-bookmark fa-lg" style="cursor: pointer;"></i>
                        </div>
                        
                        <div class="mb-2">
                            <strong>8,912 lượt thích</strong>
                        </div>
                        
                        <div class="mb-3">
                            <strong>photographer_james</strong> Bình minh trên đỉnh núi. Mỗi bức ảnh đều kể một câu chuyện. 📸 #photography #sunrise #mountains
</div>
                        
                        <div class="text-secondary" style="font-size: 10px;">
                            5 GIỜ TRƯỚC
                        </div>
                    </div>
                </div>
            @else
                <!-- Guest View - Show Instagram Intro -->
                <div class="text-center mt-5 pt-5">
                    <h1 class="instagram-logo display-4 mb-4">
                        <i class="fab fa-instagram me-3"></i>Instagram
                    </h1>
                    <p class="lead text-secondary mb-5">
                        Chia sẻ khoảnh khắc cuộc sống với bạn bè và gia đình
                    </p>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="instagram-card mb-4">
                                <h4 class="mb-4">Khám phá Instagram</h4>
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <img src="https://images.unsplash.com/photo-1519638399535-1b036603ac77?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
                                        <h6>Kết nối</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
                                        <h6>Sáng tạo</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
                                        <h6>Khám phá</h6>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="instagram-card">
                                <h5 class="mb-3">Bắt đầu ngay hôm nay</h5>
                                <a href="{{ route('register') }}" class="instagram-btn mb-3 d-inline-block w-100">
                                    Tạo tài khoản mới
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
                                    Đã có tài khoản? Đăng nhập
                                </a>
</div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<!-- Additional Instagram Style CSS -->
<style>
    /* Post Hover Effects */
    .instagram-card {
        transition: transform 0.2s;
        overflow: hidden;
    }
    
    .instagram-card:hover {
        transform: translateY(-2px);
    }
    
    /* Like Animation */
    .fa-heart {
        transition: color 0.3s;
    }
    
    .fa-heart:hover {
        color: #ed4956 !important;
    }
    
    .fa-heart.active {
        color: #ed4956 !important;
    }
    
    /* Story Ring */
    .story-ring {
        width: 66px;
        height: 66px;
        border-radius: 50%;
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
    }
    
    .story-ring img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 2px solid white;
    }
</style>

<!-- Instagram Interactive JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Like functionality
        const likeButtons = document.querySelectorAll('.fa-heart');
        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('far');
                this.classList.toggle('fas');
                this.classList.toggle('active');
            });
        });
        
        // Bookmark functionality
        const bookmarkButtons = document.querySelectorAll('.fa-bookmark');
        bookmarkButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('far');
                this.classList.toggle('fas');
            });
        });
        
        // Infinite scroll simulation
        let loading = false;
        window.addEventListener('scroll', function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500 && !loading) {
                loading = true;
                setTimeout(() => {
                    // Simulate loading more posts
                    console.log('Loading more posts...');
                    loading = false;
                }, 1000);
            }
        });
    });
</script>
@endsection
