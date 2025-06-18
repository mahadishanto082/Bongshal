@extends('layouts.website')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Product Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>

            <form method="post" action="{{ route('web.checkout.store') }}" novalidate>
                @csrf

                <div class="row justify-content-between">
                    <div class="col-12 col-lg-7 col-md-12">
                        <h5 class="mb-4 ft-medium">Shopping Details</h5>
                        <div class="row mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <ul class="no-ul-list">
                                    <li>
                                        <input id="c1" class="radio-custom" name="shipping" value="Inside dhaka" type="radio" checked>
                                        <label for="c1" class="radio-custom-label">Inside Dhaka (Tk. {{ $insideDhakaShipping }})</label>
                                    </li>

                                    <li>
                                        <input id="c2" class="radio-custom" name="shipping" value="Outside dhaka" type="radio">
                                        <label for="c2" class="radio-custom-label">Outside Dhaka (Tk. {{ $outsideDhakaShipping }})</label>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Name *</label>

                                    <input type="text" name="shipping_name"
                                           class="form-control @error('shipping_name') is-invalid @enderror"
                                           value="{{ old('shipping_name', $shippingAddress->name ?? '') }}"
                                           placeholder="Name" required/>

                                    @error('shipping_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Mobile *</label>

                                    <input type="number" name="shipping_phone"
                                           class="form-control @error('shipping_phone') is-invalid @enderror"
                                           value="{{ old('shipping_phone', $shippingAddress->phone ?? '') }}"
                                           placeholder="Mobile Number"/>

                                    @error('shipping_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Email</label>

                                    <input type="email"
                                           class="form-control @error('shipping_email') is-invalid @enderror"
                                           name="shipping_email"
                                           autocomplete="shipping_email"
                                           value="{{ old('shipping_email', $shippingAddress->email ?? '') }}"
                                           placeholder="Email">

                                    @error('shipping_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Address *</label>

                                    <input type="text" name="shipping_address_line"
                                           class="form-control @error('shipping_address_line') is-invalid @enderror"
                                           placeholder="Address"
                                           value="{{ old('shipping_address_line', $shippingAddress->address_line ?? '') }}"
                                           required
                                    >

                                    @error('shipping_address_line')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">District</label>

                                    <input type="text" name="shipping_district"
                                           class="form-control @error('shipping_district') is-invalid @enderror"
                                           placeholder="City / Town"
                                           value="{{ old('shipping_district', $shippingAddress->district ?? '') }}"
                                    >

                                    @error('shipping_district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-4 ft-medium">Billing Address </h5>
                        <div class="row mb-4">
                            <div class="col-12 d-block">
                                <input id="same_as_shipping"
                                       class="checkbox-custom"
                                       name="same_as_shipping"
                                       onchange="toggleBilling()"
                                       value="1"
                                       type="checkbox" checked>
                                <label for="same_as_shipping" class="checkbox-custom-label">Same Billing Address?</label>
                            </div>
                        </div>

                        <div class="row mb-4 d-none" id="billing-details">
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">নাম *</label>

                                    <input type="text" name="billing_name"
                                           class="form-control @error('billing_name') is-invalid @enderror"
                                           value="{{ old('billing_name', $billingAddress->name ?? '') }}"
                                           placeholder="Name" required/>

                                    @error('billing_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Mobile *</label>

                                    <input type="number" name="billing_phone"
                                           class="form-control @error('billing_phone') is-invalid @enderror"
                                           value="{{ old('billing_phone', $billingAddress->phone ?? '') }}"
                                           placeholder="Mobile Number"/>

                                    @error('billing_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Email</label>

                                    <input type="email"
                                           class="form-control @error('billing_email') is-invalid @enderror"
                                           name="billing_email"
                                           autocomplete="billing_email"
                                           value="{{ old('billing_email', $billingAddress->email ?? '') }}"
                                           placeholder="Email">

                                    @error('billing_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">Address  *</label>

                                    <input type="text" name="billing_address_line"
                                           class="form-control @error('billing_address_line') is-invalid @enderror"
                                           placeholder="Address"
                                           value="{{ old('billing_address_line', $billingAddress->address_line ?? '') }}"
                                           required
                                    >

                                    @error('billing_address_line')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="text-dark">District</label>

                                    <input type="text" name="billing_district"
                                           class="form-control @error('billing_district') is-invalid @enderror"
                                           placeholder="City / Town"
                                           value="{{ old('billing_district', $billingAddress->district ?? '') }}"
                                    >

                                    @error('billing_district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <h5 class="mb-4 ft-medium">Payment</h5>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-12 col-xl-12 col-md-12">
                                <input id="transaction_type" class="radio-custom" name="transaction_type"
                                       value="Cash on delivery"
                                       type="radio" checked>
                                <label for="transaction_type" class="radio-custom-label">Cash on delivery</label>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-12 col-lg-4 col-md-12">
                        <div class="d-block mb-3">
                            <h5 class="mb-4">Order list (@{{ cart_count_total }})</h5>
                            <template v-if="cart_count_total > 0">
                                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3" v-for="(cart, index) in cart_content" :key="index">
                                    <div class="cart_single d-flex align-items-center">
                                        <div class="cart_selected_single_thumb">
                                            <a href="#"><img :src="'/storage/products/' + cart.options.image" width="60" class="img-fluid" :alt="cart.name"/></a>
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
                                            <h4 class="fs-md ft-medium mb-0 lh-1 mt-2">Tk. @{{ cart.price }} x @{{ cart.qty }}</h4>
                                        </div>
                                    </div>
                                    <div class="fls_last">
                                        <button @click="removeCart(cart.rowId)" class="close_slide gray"><i class="ti-close"></i></button>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                                    No products in cart
                                </div>
                            </template>
                        </div>

                        <div class="card mb-4 gray">
                            <div class="card-body">
                                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                    <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                        <span>Sub-total</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ subtotal_amount }}</span>
                                    </li>
                                    <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                        <span>Discount (-)</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ total_discount_amount }}</span>
                                    </li>
                                    <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                        <span>Order total</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ total_amount }}</span>
                                    </li>

                                    <li class="list-group-item fs-sm text-center">
                                        Shipping cost *
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="mb-4 ft-medium">Reference code</h5>
                        <div class="row mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" v-model="reference_code" @keyup="checkReference" name="reference_code" class="form-control @error('reference_code') is-invalid @enderror" placeholder="Reference Code">
                                    @error('reference_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <template>
                                    <strong class="text-success" v-if="reference_status === true">
                                        <i class="fa fa-check-circle"></i> @{{ reference_message }}
                                    </strong>
                                    <strong class="text-danger" v-else-if="reference_status === false">
                                        <i class="ti-close"></i> @{{ reference_message }}
                                    </strong>
                                </template>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-dark mb-3">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('_js')
    <script>
        function toggleBilling() {
            const element = document.getElementById('billing-details');
            const sameAsShippingElement = document.getElementById('same_as_shipping');

            if (sameAsShippingElement.checked) {
                element.classList.add('d-none');
            } else {
                element.classList.remove('d-none');
            }
        }
    </script>
@endpush
