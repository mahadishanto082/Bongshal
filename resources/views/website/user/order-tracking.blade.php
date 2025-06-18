@extends('layouts.website')

@section('title')
    অর্ডার ট্র্যাকিং
@endsection

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | অর্ডার ট্র্যাকিং" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="Order Number #{{ $order->id }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">হোম</a></li>
                            <li class="breadcrumb-item active" aria-current="page">অর্ডার ট্র্যাকিং</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <!-- Single Order List -->
            <div class="ord_list_wrap border mb-4 mfliud">
                <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                    <div class="olh_flex">
                        <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
                        <h6 class="mb-0 ft-medium">#{{ $order->id }}</h6>
                    </div>

                    <div class="olh_flex">
                        <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                        <div class="delv_status">
                            @php
                                switch ($order->status) {
                                  case "Pending":
                                    $class = 'primary';
                                    break;
                                  case "In Progress":
                                    $class = 'info';
                                    break;
                                  case "Ready to Ship":
                                    $class = 'warning';
                                    break;
                                  case "Shipped":
                                    $class = 'success';
                                    break;
                                  case "Delivered":
                                    $class = 'success';
                                    break;
                                  case "Returned":
                                    $class = 'danger';
                                    break;
                                  case "Canceled":
                                    $class = 'danger';
                                    break;
                                  case "Failed":
                                    $class = 'danger';
                                    break;
                                  default:
                                    $class = 'primary';
                                }
                            @endphp
                            <span class="ft-medium small text-{{ $class }} bg-light-{{ $class }} rounded px-3 py-1">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="ord_list_body text-left">
                    @foreach($order->orderDetails as $orderDetail)
                        <!-- First Product -->
                        <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                <div class="cart_single d-flex align-items-start mfliud-bot">
                                    <div class="cart_selected_single_thumb">
                                        <a href="{{ route('web.products.details', $orderDetail->product->slug ?? '') }}">
                                            <img
                                                src="{{ asset("storage/products/". $orderDetail->product->image ?? '') }}"
                                                width="75" class="img-fluid rounded" alt="">
                                        </a>
                                    </div>

                                    <div class="cart_single_caption pl-3">
                                        <p class="mb-0"><span
                                                class="text-muted small">{{ $orderDetail->product->category->name ?? '' }}</span>
                                        </p>

                                        <h4 class="product_title fs-sm ft-medium mb-1 lh-1">
                                            {{ $orderDetail->product_name ?? '' }}
                                        </h4>

                                        <p class="mb-2">
                                            @if($orderDetail->product_size)
                                                <span
                                                    class="text-dark medium">Size: {{ $orderDetail->product_size }}</span>
                                                ,
                                            @endif
                                            @if($orderDetail->product_color)
                                                <span
                                                    class="text-dark medium">Color: {{ $orderDetail->product_color }}</span>
                                            @endif
                                        </p>

                                        <h4 class="fs-sm ft-bold mb-0 lh-1">
                                            ৳{{ $orderDetail->product_unit_price }}
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-3">
                                <p class="mb-1 p-0"><span class="text-muted">Quantity:</span></p>
                                <h6 class="mb-0 ft-medium fs-sm">{{ $orderDetail->final_quantity }}</h6>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-3">
                                <p class="mb-1 p-0"><span class="text-muted">SubTotal:</span></p>
                                <h6 class="mb-0 ft-medium fs-sm">৳{{ $orderDetail->sub_total }}</h6>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-3">
                                <p class="mb-1 p-0"><span class="text-muted">Discount:</span></p>
                                <h6 class="mb-0 ft-medium fs-sm">
                                    ৳{{ $orderDetail->discount * $orderDetail->final_quantity }}
                                </h6>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-3 text-right">
                                <p class="mb-1 p-0"><span class="text-muted">Total:</span></p>
                                <h6 class="mb-0 ft-medium fs-sm">৳{{ $orderDetail->final_total }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                    <div class="col-12 pr-0 py-2 olf_flex d-flex align-items-center justify-content-end">
                        <div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">SubTotal:
                                ৳{{ $order->sub_total }}</h5></div>
                    </div>
                </div>

                <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                    <div class="col-12 pr-0 py-2 olf_flex d-flex align-items-center justify-content-end">
                        <div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Discount:
                                ৳{{ $order->discount }}</h5></div>
                    </div>
                </div>

                <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                    <div class="col-12 pr-0 py-2 olf_flex d-flex align-items-center justify-content-end">
                        <div class="olf_inner_right">
                            <h5 class="mb-0 fs-sm ft-bold">
                                Shipping Charge:
                                ৳{{ $order->total_shipping_charge }}
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                    <div class="col-xl-3 col-lg-3 col-md-4 olf_flex text-left px-0 py-2 br-right">
                        @if(in_array($order->status, ['Pending', 'In Progress', 'Ready to Ship']))
                            <a href="javascript:void(0);"
                               class="ft-medium fs-sm"
                               onclick="cancelOrder('{{ route('web.user.orders.cancel', $order->id) }}')"
                            >
                                <i class="ti-close mr-2"></i>Cancel Order
                            </a>
                        @endif
                    </div>

                    <div
                        class="col-xl-9 col-lg-9 col-md-8 pr-0 py-2 olf_flex d-flex align-items-center justify-content-end">
                        <div class="olf_inner_right">
                            <h5 class="mb-0 fs-sm ft-bold">
                                Total: ৳{{ $order->final_total }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Order List -->
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    @include('website.share.user-custom-feature')
@endsection

@push('_js')
    <script !src="">
        function cancelOrder(route) {
            const form = document.getElementById('cancel-order-form');
            form.action = route;

            Swal.fire({
                icon: "warning",
                title: "Are you sure want to cancel this order?",
                showCancelButton: true,
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endpush
