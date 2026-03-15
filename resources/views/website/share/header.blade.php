@section('css')
<style>
    .hamburger-btn {
        font-size: 1.8rem;
        border: none;
        background: none;
        color: white;
    }

    .nav-menu i {
        margin-right: 6px;
    }

    .welcome-bar {
        background-color: #fa4c06;
        color: white;
        font-weight: bold;
    }

    .btn-shop-ride {
        background-color: #fa4c06;
        color: white;
        border: none;
        transition: background-color 0.25s ease;
    }

    .btn-shop-ride:hover {
        background-color: #e64300;
    }

    .cart-subtotal {
        font-size: 0.9rem;
    }

    .welcome-text-bar span {
        font-size: 0.95rem;
        line-height: 1.4;
    }

    @media (max-width: 991px) {
        .desktop-only { display: none !important; }
        .search-form-mobile { width: 100%; }
        .headd-sty-wrap { flex-wrap: wrap; gap: 12px; }
        .headd-sty-last ul { gap: 12px !important; }
    }

    @media (min-width: 992px) {
        .mobile-only { display: none !important; }
    }
</style>
@endsection

<!-- Welcome Carousel Bar -->
@if(!empty($welcome_text) && count($welcome_text) > 0)
<div id="textCarousel" class="carousel slide welcome-bar" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner text-center py-2 py-md-3">
        @foreach($welcome_text as $index => $text)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="d-flex justify-content-center align-items-center gap-2 gap-md-3 px-3">
                <i class="fas fa-info-circle"></i>
                <span>{{ $text->content }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#textCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#textCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

<!-- Main Header -->
<header class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark px-0">
            <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-3 py-2 py-lg-3">

                <!-- Left – Logo + Category button + Search -->
                <div class="d-flex align-items-center flex-grow-1 gap-3">

                    <!-- Logo -->
                    <a class="navbar-brand p-0 me-2" href="{{ route('web.home') }}">
                        <img src="{{ asset('Bongshal.jpeg') }}" class="logo" alt="Logo" style="height: 48px; width: auto;">
                    </a>

                    <!-- Shop Your Ride Button -->
                    <button class="btn btn-shop-ride px-3 py-2 d-none d-md-flex align-items-center gap-2">
                        <img src="football (2).png" alt="icon" style="width:32px; height:32px;"/>
                        SHOP YOUR RIDE
                    </button>

                    <!-- Search -->
                    <div class="flex-grow-1 search-form-mobile">
                        <form action="{{ route('web.products.index') }}" class="input-group input-group-sm">
                            <select class="form-select" name="category_id" style="max-width: 160px;">
                                <option selected disabled hidden>Select Category</option>
                                @foreach(getCategories() as $category)
                                    <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control" name="keyword" value="{{ request()->keyword }}" placeholder="Search products...">
                            <button class="btn btn-outline-light" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right side icons / user / cart -->
                <div class="d-flex align-items-center gap-3 gap-md-4 headd-sty-last">

                    <!-- Order Tracking -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#orderTrack" class="text-white">
                        <i class="lni lni-map-marker" style="font-size: 1.6rem;"></i>
                    </a>

                    <!-- Cart -->
                    <a href="#" onclick="openCart()" class="text-white position-relative d-flex flex-column align-items-center text-decoration-none" style="min-width: 50px;">
                        <i class="fas fa-shopping-cart fs-3"></i>
                        <span v-cloak class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger small" id="cart-count-badge">@{{ cart_count_total || 0 }}</span>
                        <span class="small d-none d-md-block">Cart</span>
                    </a>

                    <!-- Wishlist -->
                    <a href="{{ route('web.user.wishlist') }}" class="text-white position-relative d-flex flex-column align-items-center text-decoration-none" style="min-width: 50px;">
                        <i class="far fa-heart fs-3"></i>
                        <span v-cloak class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger small">
                            {{ $wishlist_count_total ?? 0 }}
                        </span>
                        <span class="small d-none d-md-block">Wishlist</span>
                    </a>

                    <!-- User / Login -->
                    @if(auth('web')->check())
                        <div class="dropdown">
                            <a class="text-white d-flex align-items-center gap-2 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle fs-4"></i>
                                <span class="d-none d-md-inline">{{ auth('web')->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('web.user.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('web.user.orders') }}">My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('web.user.user_addresses.index') }}">Addresses</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white">
                            <i class="lni lni-user fs-4"></i>
                        </a>
                    @endif

                    <!-- Hamburger – only ONE, only visible < lg -->
                    <button class="hamburger-btn d-lg-none p-0 ms-2"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#mainOffcanvas">
                        ☰
                    </button>
                </div>

            </div>
        </nav>
    </div>
</header>

<!-- Secondary Navigation Bar (NO toggler button here) -->
<div class="bg-dark border-top border-bottom border-secondary">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark px-0 py-2">
            <div class="container-fluid p-0">

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav gap-4 gap-lg-5">
                        <li class="nav-item"><a class="nav-link" href="{{ route('web.home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('web.categories') }}"><i class="fas fa-cube"></i> Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('web.products.index') }}"><i class="fas fa-shopping-cart"></i> All Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-address-card"></i> About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('web.contactUs') }}"><i class="fas fa-address-book"></i> Contact</a></li>
                    </ul>
                </div>

                <div class="d-none d-lg-block">
                    <img src="{{ asset('common tread.png') }}" alt="" style="height: 42px; width: auto;">
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Mobile Bottom Navigation Bar -->
<div class="fixed-bottom bg-black border-top border-secondary d-lg-none" style="z-index: 1030;">
    <div class="d-flex justify-content-around align-items-center py-2 text-white">
        <a href="{{ route('web.home') }}" class="text-white text-center text-decoration-none">
            <i class="fas fa-home fs-4"></i><br>
            <span class="small">Home</span>
        </a>
        <a href="{{ route('web.categories') }}" class="text-white text-center text-decoration-none">
            <i class="fas fa-th-large fs-4"></i><br>
            <span class="small">Categories</span>
        </a>
        <a href="#" id="mobileSearchToggle" class="text-white text-center text-decoration-none">
            <i class="fas fa-search fs-4"></i><br>
            <span class="small">Search</span>
        </a>
        <a href="#" onclick="openCart()" class="text-white text-center text-decoration-none position-relative">
            <i class="fas fa-shopping-cart fs-4"></i>
            <span v-cloak class="position-absolute top-0 start-100 translate-middle badge bg-danger small" id="cart-count-badge-mobile">@{{ cart_count_total || 0 }}</span><br>
            <span class="small">Cart</span>
        </a>
        <a href="{{ auth('web')->check() ? route('web.user.profile') : route('login') }}" class="text-white text-center text-decoration-none">
            <i class="fas fa-user fs-4"></i><br>
            <span class="small">Account</span>
        </a>
    </div>
</div>

<!-- Offcanvas Menu (mobile) -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mainOffcanvas">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column nav-pills gap-2">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('web.home') }}"><i class="fas fa-home me-2"></i>Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('web.categories') }}"><i class="fas fa-cube me-2"></i>Categories</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('web.products.index') }}"><i class="fas fa-shopping-cart me-2"></i>All Products</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-address-card me-2"></i>About Us</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('web.contactUs') }}"><i class="fas fa-address-book me-2"></i>Contact</a></li>
        </ul>
    </div>
</div>

<div class="clearfix"></div>

<script>
    function updateCartUI(count, total) {
        const badge = document.getElementById('cart-count-badge');
        const badgeMobile = document.getElementById('cart-count-badge-mobile');
        if (badge) badge.textContent = count;
        if (badgeMobile) badgeMobile.textContent = count;
    }
</script>