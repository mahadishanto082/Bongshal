<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <img src="{{ asset('Bongshal.jpeg') }}" class="img-footer small mb-2" alt="" />
                        @if(getSetting() && getSetting()->title)
                            <div class="address">
                                {{ getSetting()->title }}
                            </div>
                        @endif

                        @if(getSetting() && getSetting()->address)
                            <div class="address mt-3">
                                {{ getSetting()->address }}
                            </div>
                        @endif

                        @if(getSetting() && getSetting()->mobile)
                            <div class="address mt-3">
                                {{ getSetting()->mobile }}
                            </div>
                        @endif
                        @if(getSetting() && getSetting()->email)
                            <div class="address">
                                {{ getSetting()->email }}
                            </div>
                        @endif
                        <div class="address mt-3">
                            <ul class="list-inline">
                                @if(getSetting() && getSetting()->facebook)
                                    <li class="list-inline-item"><a href="{{ getSetting()->facebook }}" target="_new"><i class="lni lni-facebook-filled"></i></a></li>
                                @endif
                                @if(getSetting() && getSetting()->twitter)
                                    <li class="list-inline-item"><a href="{{ getSetting()->twitter }}" target="_new"><i class="lni lni-twitter-filled"></i></a></li>
                                @endif
                                @if(getSetting() && getSetting()->youtube)
                                    <li class="list-inline-item"><a href="{{ getSetting()->youtube }}" target="_new"><i class="lni lni-youtube"></i></a></li>
                                @endif
                                @if(getSetting() && getSetting()->instagram)
                                    <li class="list-inline-item"><a href="{{ getSetting()->instagram }}" target="_new"><i class="lni lni-instagram-filled"></i></a></li>
                                @endif
                                @if(getSetting() && getSetting()->linkedin)
                                    <li class="list-inline-item"><a href="{{ getSetting()->linkedin }}" target="_new"><i class="lni lni-linkedin-original"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Support</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('web.home') }}">Home</a></li>
                            <li><a href="{{ route('web.categories') }}">Catagory</a></li>
                            <li><a href="{{ route('web.products.index') }}">All Products</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Shop</h4>
                        <ul class="footer-menu">
                            @foreach(getCategories(5) as $category)
                                <li><a href="{{ route('web.categories.products', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Company</h4>
                        <ul class="footer-menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="{{ route('web.contactUs') }}">Contact</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Regsiter</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="footer_widget">
                        <h4 class="widget_title">Subscribe</h4>
                        <p>Bongshal.com is a new breed of motorcycle community. Providing the best experience of today's online shopping mall enhanced with useful features and categories tailored to motorcycle enthusiasts of all types, Bongshal.com is an open platform for the exchange of everything related to motorcycle.</p>
                        <div class="foot-news-last">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email Address">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text b-0 text-light"><i class="lni lni-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>

                        <ul class="footer-menu">
                            <li>
                                <a href="{{ asset('assets/Hajjshops.apk') }}" download>
                                    <img class="img-fluid" src="{{ asset('assets/website/img/download.png') }}" alt="Android download">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                  <p class="mb-0">© {{ date('Y') }} Bongshal All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<nav class="footer-nav">
    <div class="mb-nav-item {{ Request::routeIs('web.home') ? 'active' : '' }}">
        <a href="{{ route('web.home') }}">
            <span class="text-white"><i class="fas fa-home"></i></span>
            <div class="title">Home</div>
        </a>
    </div>

    <div class="mb-nav-item {{ Request::routeIs('web.cart*') ? 'active' : '' }}">
        <a href="{{ route('web.cart.view') }}">
            <span class="text-white"><i class="fas fa-shopping-cart"></i> <span style="font-size: 16px;" class="dn-counter">@{{ cart_count_total }}</span> </span>
            <div class="title">Cart </div>
        </a>
    </div>

    <div class="mb-nav-item {{ Request::routeIs('web.contactUs*') ? 'active' : '' }}">
        <a href="{{ route('web.contactUs') }}">
            <span class="text-white"><i class="lni lni-envelope"></i></span>
            <div class="title">Massage </div>
        </a>
    </div>

    <div class="mb-nav-item" {{ Request::routeIs('web.user*') ? 'active' : '' }}>
        <a href="{{ route('web.user.profile') }}">
            <span class="text-white"><i class="fas fa-user"></i></span>
            <div class="title">Profile</div>
        </a>
    </div>
</nav>

<!-- ============================ Footer End ================================== -->

<!-- Search -->
<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Search">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Search Products</h4>
            <button onclick="closeSearch()" class="close_slide"><i class="ti-close"></i></button>
        </div>

        <div class="cart_action px-3 py-4">
            <form class="form m-0 p-0" action="{{ route('web.products.index') }}" method="get">
                <div class="form-group">
                    <input value="{{ request()->keyword }}" name="keyword"  type="text" class="form-control" placeholder="Product Keyword.." />
                </div>

                <div class="form-group">
                    <select class="custom-select" name="category_id">
                        <option selected disabled hidden value="">Select Category</option>
                        @foreach(getCategories() as $category)
                            <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn d-block full-width btn-dark">Search Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cart -->
<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Open Cart</h4>
            <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
        </div>
        <div class="right-ch-sideBar">

            <div class="cart_select_items py-2">
                <template v-if="cart_count_total > 0">
                    <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3" v-for="(cart, index) in cart_content" :key="index">
                        <div class="cart_single d-flex align-items-center">
                            <div class="cart_selected_single_thumb">
                                <a href="#"><img :src="'/storage/products/' + cart.options.image" width="60" class="img-fluid" :alt="cart.name" /></a>
                            </div>
                            <div class="cart_single_caption pl-2">
                                <h4 class="product_title fs-sm ft-medium mb-0 lh-1 mb-2">@{{ cart.name }}</h4>
                                <p v-if="cart.options.product_color" style="margin: -8px 0 -10px 0;">
                                    <span class="text-dark ft-medium small">Color: @{{ cart.options.product_color }}</span>
                                </p>
                                <p v-if="cart.options.product_size" style="margin: -8px 0 -10px 0;">
                                    <span class="text-dark ft-medium small">Size: @{{ cart.options.product_size }}</span>
                                </p>
                                <p v-if="cart.options.product_fabrics" style="margin: -8px 0 -10px 0;">
                                    <span class="text-dark ft-medium small">Fabrics: @{{ cart.options.product_fabrics }}</span>
                                </p>
                                <h4 class="fs-md ft-medium mb-0 mt-2 lh-1">Tk. @{{ cart.price }} x @{{ cart.qty }}</h4>
                            </div>
                        </div>
                        <div class="fls_last"><button @click="removeCart(cart.rowId)" class="close_slide gray"><i class="ti-close"></i></button></div>
                    </div>
                </template>
                <template v-else>
                    <div class="d-flex align-items-center text-danger text-center justify-content-between br-bottom px-3 py-3">
                        No product found in cart.
                    </div>
                </template>
            </div>

            <template v-if="cart_count_total > 0">
                <div class="d-flex align-items-center justify-content-between br-top br-bottom px-1 py-1">
                    <h6 class="mb-0">Subtotal</h6>
                    <h3 style="line-height: 0; font-size: 15px" class="mb-0 ft-medium">Tk. @{{ subtotal_amount }}</h3>
                </div>
                <div class="d-flex align-items-center justify-content-between br-top br-bottom px-1 py-1">
                    <h6 class="mb-0">Discount (-)</h6>
                    <h3 style="line-height: 0; font-size: 15px" class="mb-0 ft-medium">Tk. @{{ total_discount_amount }}</h3>
                </div>
                <div class="d-flex align-items-center justify-content-between br-top br-bottom px-1 py-1">
                    <h6 class="mb-0">Order Total</h6>
                    <h3 style="line-height: 0; font-size: 18px" class="mb-0 ft-medium">Tk. @{{ total_amount }}</h3>
                </div>

                <div class="cart_action px-3 py-3">
                    <div class="form-group">
                        <a href="{{ route('web.checkout.index') }}" class="btn d-block full-width btn-dark">Checkout Now</a>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('web.cart.view') }}" class="btn d-block full-width btn-dark-light">Edit or View</a>
                    </div>
                </div>
            </template>

        </div>
    </div>
</div>

<!-- Product View Modal -->
<div class="modal fade lg-modal" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickviewmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl login-pop-form" role="document">
        <div class="modal-content" id="quickviewmodal">
            <div class="modal-headers">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ti-close"></span>
                </button>
            </div>

            <div class="modal-body">
                <div class="quick_view_wrap">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

<form method="post" id="delete-form">
    @csrf
    @method('delete')
</form>

<form method="post" id="cancel-order-form">
    @csrf
</form>

<div class="modal fade" id="orderTrack" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl login-pop-form" role="document">
        <div class="modal-content" id="loginmodal">
            <div class="modal-headers">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ti-close"></span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="text-center mb-4">
                    <h2 class="m-0 ft-regular">Place your order number</h2>
                </div>

                <form method="post" action="{{ route('web.orders.trackCheck') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="order_number" placeholder="Order Number*" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Check</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
