@section('css')
    <style>
        :root {
            --header-bg: #000000;
            --search-bg: rgba(255, 255, 255, 0.1);
            --border-light: rgba(255, 255, 255, 0.15);
            --primary-glow: rgba(250, 76, 6, 0.3);
        }

        .premium-header {
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border-light);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .welcome-bar {
            background: linear-gradient(90deg, #fa4c06 0%, #ff6a2e 100%);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .search-wrap-premium {
            background: var(--search-bg);
            border: 1px solid var(--border-light);
            border-radius: 50px;
            padding: 4px 15px;
            transition: all 0.3s ease;
        }

        .search-wrap-premium:focus-within {
            background: rgba(255, 255, 255, 0.12);
            border-color: #fa4c06;
            box-shadow: 0 0 15px var(--primary-glow);
        }

        .search-wrap-premium .form-select,
        .search-wrap-premium .form-control {
            background: transparent !important;
            color: #fff !important;
            border: none !important;
            box-shadow: none !important;
            font-size: 0.9rem;
        }

        .search-wrap-premium .form-select {
            max-width: 130px;
            border-right: 1px solid var(--border-light) !important;
            border-radius: 0;
            padding-right: 25px;
        }

        .search-wrap-premium .form-select option {
            background: #2d3436;
            color: white;
        }

        .utility-icon-premium {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            padding: 5px 10px;
        }

        .utility-icon-premium:hover {
            color: #fa4c06;
            transform: translateY(-3px);
        }

        .utility-icon-premium i {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }

        .utility-icon-premium .badge {
            position: absolute;
            top: 0;
            right: 2px;
            font-size: 0.65rem;
            padding: 3px 6px;
            border: 2px solid var(--header-bg);
        }

        .btn-shop-ride {
            background: #fa4c06;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            padding: 8px 20px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(250, 76, 6, 0.2);
        }

        .btn-shop-ride:hover {
            background: #e64300;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(250, 76, 6, 0.4);
            color: #fff;
        }

        .secondary-nav-premium {
            background: #000000;
            border-bottom: 1px solid var(--border-light);
            border-top: 1px solid var(--border-light);
        }

        .secondary-nav-premium .nav-link {
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding: 12px 15px !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .secondary-nav-premium .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #fa4c06;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .secondary-nav-premium .nav-link:hover {
            color: #fff;
        }

        .secondary-nav-premium .nav-link:hover:after {
            width: 70%;
        }

        .hamburger-btn {
            color: #fff;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .hamburger-btn:hover {
            color: #fa4c06;
        }

        @media (max-width: 991px) {
            .search-form-mobile { margin-top: 10px; order: 3; }
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
<header class="premium-header sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg px-0 py-0">
            <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-3 py-2 py-lg-3">

                <!-- Left – Logo + Category button -->
                <div class="d-flex align-items-center gap-4">
                    <a class="navbar-brand p-0" href="{{ route('web.home') }}">
                        <img src="{{ asset('Bongshal.jpeg') }}" class="logo rounded-3" alt="Logo" style="height: 50px; width: auto; border: 1px solid var(--border-light);">
                    </a>

                    <button class="btn-shop-ride d-none d-xl-flex">
                        <i class="fas fa-motorcycle fa-lg"></i>
                        <span>SHOP YOUR RIDE</span>
                    </button>
                </div>

                <!-- Center - Search -->
                <div class="flex-grow-1 mx-lg-4 search-form-mobile">
                    <form action="{{ route('web.products.index') }}" class="search-wrap-premium d-flex align-items-center">
                        <select class="form-select" name="category_id">
                            <option selected disabled hidden>Categories</option>
                            @foreach(getCategories() as $category)
                                <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control px-3" name="keyword" value="{{ request()->keyword }}" placeholder="Search gear, parts, and more...">
                        <button class="btn btn-link text-white p-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Right side icons -->
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#orderTrack" class="utility-icon-premium" title="Track Order">
                        <i class="fas fa-shipping-fast"></i>
                        <span class="small d-none d-lg-block">Track</span>
                    </a>

                    <a href="{{ route('web.user.wishlist') }}" class="utility-icon-premium">
                        <i class="far fa-heart"></i>
                        <span class="badge rounded-pill bg-danger">{{ $wishlist_count_total ?? 0 }}</span>
                        <span class="small d-none d-lg-block">Wishlist</span>
                    </a>

                    <a href="#" onclick="openCart()" class="utility-icon-premium">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge rounded-pill bg-primary" id="cart-count-badge">@{{ cart_count_total || 0 }}</span>
                        <span class="small d-none d-lg-block">Cart</span>
                    </a>

                    @if(auth('web')->check())
                        <div class="dropdown">
                            <a class="utility-icon-premium dropdown-toggle border-0 bg-transparent" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>
                                <span class="small d-none d-lg-block">{{ explode(' ', auth('web')->user()->name)[0] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2" style="background: #2d3436; border-radius: 12px;">
                                <li><a class="dropdown-item text-white py-2" href="{{ route('web.user.profile') }}"><i class="fas fa-id-card me-2 text-primary"></i> Profile</a></li>
                                <li><a class="dropdown-item text-white py-2" href="{{ route('web.user.orders') }}"><i class="fas fa-box me-2 text-primary"></i> My Orders</a></li>
                                <li><hr class="dropdown-divider bg-light opacity-10"></li>
                                <li>
                                    <a class="dropdown-item text-danger py-2" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="utility-icon-premium">
                            <i class="fas fa-user"></i>
                            <span class="small d-none d-lg-block">Login</span>
                        </a>
                    @endif

                    <button class="hamburger-btn d-lg-none bg-transparent border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainOffcanvas">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

            </div>
        </nav>
    </div>
</header>

<!-- Secondary Navigation Bar -->
<div class="secondary-nav-premium d-none d-lg-block">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item"><a class="nav-link" href="{{ route('web.home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('web.categories') }}">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('web.products.index') }}">Shop All</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('web.contactUs') }}">Contact</a></li>
        </ul>
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
            <span class="position-absolute top-0 start-100 translate-middle badge bg-danger small" id="cart-count-badge-mobile">@{{ cart_count_total ?? 0 }}</span><br>
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