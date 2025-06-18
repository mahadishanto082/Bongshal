@extends('layouts.website')

@section('title')
    Cart
@endsection

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Cart" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('_css')
    <style>
        .qty-input {
            border: 1px solid #ccc;
            font-weight: bold;
            padding: 15px;
            width: 50px;
            text-align: center;
        }
        .qty-input-btn {
            cursor: pointer;
            background-color: #ccc;
            padding: 15px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="middle">
        <div class="container">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center d-block mb-5">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-lg-7 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Product name</th>
                                <th>Size/Color/Fabrics</th>
                                <th>Unit Price</th>
                                <th width="20%">Quantity</th>
                                <th>Total</th>
                                <th class="text-end">Close</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="cart_count_total > 0">
                                <tr v-for="cart in cart_content">
                                    <td>
                                        <img width="80" class="media-object" :src="'/storage/products/'+cart.options.image" :alt="cart.name">
                                    </td>
                                    <td>
                                        @{{ cart.name }}
                                    </td>
                                    <td>
                                        @{{ cart.options.product_size }} / @{{ cart.options.product_color }} / @{{ cart.options.product_fabrics }}
                                    </td>
                                    <td>Tk. @{{ cart.price }}</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <div class="qty-input-btn" @click="updateCart(cart.rowId, 'decrement')">
                                                <span class="input-group-text">-</span>
                                            </div>
                                            <div class="qty-input">@{{ cart.qty }}</div>
                                            <div class="qty-input-btn" @click="updateCart(cart.rowId, 'increment')">
                                                <span class="input-group-text">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Tk. @{{ cart.subtotal }} </td>
                                    <td>
                                        <div  @click="removeCart(cart.rowId)" class="fls_last"><button class="close_slide gray"><i class="ti-close"></i></button></div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="6" class="text-center">No Cart Item</td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card mb-4 gray mfliud">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ subtotal_amount }}</span>
                                </li>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Discount (-)</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ total_discount_amount }}</span>
                                </li>
                                <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    <span>Total amount</span> <span class="ml-auto text-dark ft-medium">Tk. @{{ total_amount }}</span>
                                </li>

                                <li class="list-group-item fs-sm text-center">
                                    Shipping cost *
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a class="btn btn-block btn-dark mb-3" href="{{ route('web.checkout.index') }}">Checkout now</a>

                    <a class="btn-link text-dark ft-medium" href="{{ route('web.products.index') }}">
                        <i class="ti-back-left mr-2"></i> New Shopping
                    </a>
                </div>

            </div>

        </div>
    </section>
@endsection
