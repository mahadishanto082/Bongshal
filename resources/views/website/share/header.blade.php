<div class=" gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
            </div>

        </div>
    </div>
</div> 
@section('css')
<style>
    .hamburger-btn {
      font-size: 1.5rem;
      border: none;
      background: none;
    }

    .nav-menu i {
      margin-right: 8px;
    }
  

  </style>

<div class="headd-sty">
    <!-- Header-msg -->
    @if(!empty($welcome_text) && count($welcome_text) > 0)
<div id="textCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
  <div class="carousel-inner text-center py-3" style="background-color: #fa4c06;">
    
    @foreach($welcome_text as $index => $text)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <div class="welcome-text-bar ">
          <div class="container d-flex justify-content-center align-items-center text-white fw-bold gap-3">
            <i class="fas fa-info-circle"></i>
            <span>{{ $text->content }}</span>
          </div>
        </div>
      </div>
    @endforeach

  </div>

  <!-- Carousel Controls: Smaller & Closer -->
  <button class="carousel-control-prev" type="button" data-bs-target="#textCarousel" data-bs-slide="next"
    style="top: 50%; left: 200px; transform: translateY(-50%); width: 25px; height: 25px;">
    <span class="carousel-control-prev-icon" style="width: 15px; height: 15px;"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#textCarousel" data-bs-slide="prev"
    style="top: 50%; right: 200px; transform: translateY(-50%); width: 25px; height: 25px;">
    <span class="carousel-control-next-icon" style="width: 15px; height: 15px;"></span>
  </button>

</div>
@endif

    
    
    
    <!-- Header -->
      
        <div style="background-color: black;">   
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 " >
                    <div class="headd-sty-wrap  d-flex align-items-center justify-content-between py-3; " >
                        <div class="headd-sty-left d-flex align-items-center ">
                            <div class="headd-sty-01 ">
                                <a class="nav-brand py-0" href="{{ route('web.home') }}">
                                    <img src="{{ asset('Bongshal.jpeg') }}" class="logo" alt="" />
                                </a>
                            </div>
                            <div class="headd-sty-01 ml-3">
                                <button 
                                    style="
                                    width: 180px; 
                                    
                                    background-color: #fa4c06; 
                                    color: white; 
                                    padding: 10px; line-height: 1; 
                                    border: none; 
                                    border-radius: 4px; 
                                    cursor: pointer; 
                                    font-weight: bold;
                                    transition: background-color 0.3s ease;
                                    "
                                    onmouseover="this.style.backgroundColor='#e64300';"
                                    onmouseout="this.style.backgroundColor='#fa4c06';"
                                >
                                <img src="football (2).png" alt="icon" style="width:35px; height:35px;"/>
                                SHOP YOUR RIDE
                                </button>
                                </div>


                            <!-- Search Form -->
                            <div class="headd-sty-02 ml-3"  style="margin: 0; padding: 10px; line-height: 1;">
                                <form action="{{ route('web.products.index') }}" class="bg-white rounded-md border-bold">
                                    <div class="input-group">
                                        <div class="input-group-prepend br-right hd-small">
                                            <div class="form-group mb-0 position-relative">
                                                <select class="custom-select b-0" name="category_id">
                                                    <option selected disabled hidden value="">Select Catagory </option>
                                                    @foreach(getCategories() as $category)
                                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control custom-height b-0" value="{{ request()->keyword }}" name="keyword" placeholder="Search for products..." />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><button class="btn bg-white text-danger custom-height rounded px-3" type="submit"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="headd-sty-last">
                            <ul class="nav-menu nav-menu-social d-flex align-items-center" style="gap: 10px; margin: 0; padding: 0; list-style: none;">

                                <!-- Membership Button -->
                                <!-- <li>
                                <button style="background-color: black; border: none; padding: 0;">
                                    <img src="{{ asset('membership.png') }}" alt="Membership" style="width: 120px; height: 35px;">
                                </button>
                                </li> -->

                                    <!-- Order Tracking -->
                                <li>
                                    <div class="dropdown js-dropdown">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#orderTrack" class="text-muted medium" 
                                        style="font-weight: 600; font-size: 18px;">
                                        <i class="lni lni-map-marker" style="font-size: 22px; color :aliceblue ; gap:3px" ></i>
                                        </a>
                                    </div>
                                 </li>

                                <!-- User Profile/Login -->
                                <li>
                                @if(auth('web')->check())
                                    <div class="dropdown language-selector-wrapper">
                                    <a class="popup-title d-flex align-items-center text-white" href="javascript:void(0)" data-toggle="dropdown" title="User Menu" style="gap: 6px;">
                                        <i class="fas fa-user-circle fs-3"></i>
                                        <span class="iso_code medium">
                                        {{ auth('web')->user()->name }}
                                        @if(auth('web')->user()->role == 'Agent')
                                            ({{ auth('web')->user()->point }})
                                        @endif
                                        </span>
                                        <i class="fa fa-angle-down medium"></i>
                                    </a>

                                    <ul class="dropdown-menu popup-content link">
                                        <li><a href="{{ route('web.user.profile') }}" class="dropdown-item medium text-muted">Profile</a></li>
                                        <li><a href="{{ route('web.user.orders') }}" class="dropdown-item medium text-muted">My Order</a></li>
                                        <li><a href="{{ route('web.user.user_addresses.index') }}" class="dropdown-item medium text-muted">Address</a></li>
                                        <li>
                                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item medium text-muted">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        </li>
                                    </ul>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="text-white medium">
                                    <i class="lni lni-user"></i>
                                    </a>
                                @endif
                                </li>

                                <!-- Compare -->
                                <li>
                                <a href="{{ route('web.user.compare') }}" onclick="AddCompare()">
                                    <div class="d-flex align-items-center">
                                    <i class="lni lni-balance fs-lg"></i>
                                    <span class="dn-counter theme-bg">{{ $wishlist_count_total }}</span>
                                    <i class="fas fa-exchange-alt text-primary ml-1"></i>
                                    </div>
                                </a>
                                </li>

                                <!-- Wishlist -->
                                <li>
                                <a href="{{ route('web.user.wishlist') }}" onclick="openWishlist()">
                                    <div class="d-flex align-items-center">
                                    <i class="lni lni-heart fs-lg"></i>
                                    <span class="dn-counter theme-bg">{{ $wishlist_count_total }}</span>
                                    </div>
                                </a>
                                </li>

                                <!-- Cart -->
                                <li>
                                <a href="#" onclick="openCart()">
                                    <div class="d-flex align-items-center">
                                    <i class="fas fa-shopping-basket fs-lg"></i>
                                    <span class="dn-counter theme-bg">@{{ cart_count_total }}</span>
                                    <div class="ml-2 text-left">
                                        <div class="text-muted small lh-1">Total</div>
                                        <div class="primary-text cart-subtotal">
                                        <span class="fs-md ft-medium"><span class="prc-currency">Tk.</span>@{{ total_amount }}</span>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                                </li>

                            </ul>
                        </div>

                            
                            
                        </div>
                        <div class="mobile_nav">
                            <ul>
                                <li>
                                    <a href="#" onclick="openSearch()">
                                        <i class="lni lni-search-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="openCart()">
                                        <i class="lni lni-shopping-basket"></i><span class="dn-counter">@{{ cart_count_total }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</div>

<!-- Top Navbar Wrapper -->
<div class="header head-style-2">
  <div class="container">
    <nav id="navigation" class="navigation navigation-landscape">
      <div class="nav-header d-flex align-items-center justify-content-between" style="width: 100%;">
        
        <!-- Hamburger Button -->
        <button class="hamburger-btn ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainOffcanvas" aria-controls="mainOffcanvas">
          ☰
        </button>

        <!-- Centered Menu -->
        <div class="nav-menus-wrapper flex-grow-1 d-flex justify-content-center">
          <ul class="nav-menu d-flex gap-3 list-unstyled mb-0">
            <li><a href="{{ route('web.home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('web.categories') }}"><i class="fas fa-cube"></i> Categories</a></li>
            <li><a href="{{ route('web.products.index') }}"><i class="fas fa-shopping-cart"></i> All Products</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i> About Us</a></li>
            <li><a href="{{ route('web.contactUs') }}"><i class="fas fa-address-book"></i> Contact</a></li>
          </ul>
        </div>
        <!-- Right Side Menu -->
        <img src="{{ asset('common tread.png') }}" class="logo" alt="" style="height: 50px; width: auto; margin-right: 20px;" />        

      </div>
    </nav>
  </div>
  <hr style="
  border: none;
  height: 1.5px;
  background-color: #fa4c06;
  margin: 0;
  width: 100vw;
" />

</div>



<!-- Full-width HR outside .container -->


<!-- Offcanvas for mobile view -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mainOffcanvas" aria-labelledby="mainOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mainOffcanvasLabel">Navigation</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column nav-menu">
      <li class="nav-item"><a class="nav-link" href="{{ route('web.home') }}"><i class="fas fa-home"></i> Home</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('web.categories') }}"><i class="fas fa-cube"></i> Categories</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('web.products.index') }}"><i class="fas fa-shopping-cart"></i> All Products</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-address-card"></i> About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('web.contactUs') }}"><i class="fas fa-address-book"></i> Contact</a></li>
    </ul>
    
 
  </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>