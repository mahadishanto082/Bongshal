<form action="{{ route('web.cart.quickAddCart', $product->slug) }}" method="post">
    @csrf
    <div class="row">
        <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <img class="img-fluid" src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}">
        </div> -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="prd_details">

                @if($product->stock > 0)
                    <div class="prt_01 mb-2">
                        <span class="text-success bg-light-success rounded px-2 py-1">Stock Available</span>
                    </div>
                @else
                    <div class="prt_01 mb-2"><span class="text-danger bg-light-danger rounded px-2 py-1">Out Of Stock</span></div>
                @endif
                <div class="prt_02 mb-3">
                    <h2 class="ft-bold mb-1">{{ $product->name }}</h2>
                    <div class="text-left">
                        @if($product->discount_value > 0 && $product->discount_type)
                            <div class="elis_rty">
                                <span class="text-muted ft-medium line-through mr-2">Tk. {{ $product->price }}</span>
                                <span class="ft-bold theme-cl fs-md">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                <span class="badge bg-green text-white ft-regular ab-right text-upper ml-5">
                                            @if($product->discount_type == 'Taka')
                                        -{{ $product->discount_value }} Tk
                                    @else
                                        -{{ $product->discount_value }}%
                                    @endif
                                        </span>
                            </div>
                        @else
                            <div class="elis_rty">
                                <span class="ft-bold text-dark fs-sm">Tk. {{ $product->price }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">

                    @if($product->point > 0 && auth('web')->check() && auth('web')->user()->role == 'Agent')
                        <div class="col-md-12">
                            <div class="prt_04 mb-4">
                                <p class="d-flex align-items-center mb-1">
                                    এই পণ্য অর্ডার করলেই আপনি পাচ্ছেন <strong class="fs-sm text-dark ft-medium ml-1">{{ $product->point }} &nbsp;</strong> পয়েন্ট
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <div class="prt_04 mb-4">
                            <p class="d-flex align-items-center mb-1">Category:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->category->name }}</strong></p>
                            @if($product->brand)
                                <p class="d-flex align-items-center mb-0">Brand:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->brand->name }}</strong></p>
                            @endif
                            @if($product->merchant)
                                <p class="d-flex align-items-center mb-0">Merchant:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->merchant->name }}</strong></p>
                            @endif
                        </div>
                    </div>
                    @if($product->type == 'Book')
                        <div class="col-md-6">
                            <div class="prt_04 mb-4">
                                @if($product->writer)
                                    <p class="d-flex align-items-center mb-0">Writer:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->writer->name }}</strong></p>
                                @endif
                                @if($product->first_release)
                                    <p class="d-flex align-items-center mb-0">First Release:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->first_release }}</strong></p>
                                @endif
                                @if($product->language)
                                    <p class="d-flex align-items-center mb-0">Language:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->language }}</strong></p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="prt_04 mb-4">
                                @if($product->weight)
                                    <p class="d-flex align-items-center mb-0">Weight:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->weight }}</strong></p>
                                @endif
                                @if($product->warranty)
                                    <p class="d-flex align-items-center mb-0">Warranty:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->warranty }}</strong></p>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($product->delivery_info || $product->shipping_in_dhaka || $product->shipping_out_dhaka)
                        <div class="col-md-12">
                            <div class="prt_04 mb-4">
                                @if($product->delivery_info)
                                    <p class="d-flex align-items-center mb-0">Delivery:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->delivery_info }}</strong></p>
                                @endif
                                @if(getSetting() && getSetting()->shipping_in_dhaka)
                                    <p class="d-flex align-items-center mb-0">Shipping in dhaka city:<strong class="fs-sm text-dark ft-medium ml-1">Tk. {{ getSetting()->shipping_in_dhaka }}</strong></p>
                                @endif
                                @if(getSetting() && getSetting()->shipping_out_dhaka)
                                    <p class="d-flex align-items-center mb-0">Out of dhaka city:<strong class="fs-sm text-dark ft-medium ml-1">Tk. {{ getSetting()->shipping_out_dhaka }}</strong></p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @if($product->size)
                    @php
                        $sizes = json_decode($product->size);
                    @endphp
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                        <div class="text-left pb-0 pt-2">
                            @foreach($sizes as $key => $size)
                                <div class="form-check size-option form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="product_size" value="{{ $size }}" id="size{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                    <label class="form-option-label" for="size{{ $key }}">{{ $size }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($product->color)
                    @php
                        $colors = json_decode($product->color);
                    @endphp
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                        <div class="text-left pb-0 pt-2">
                            @foreach($colors as $key => $color)
                                <div class="form-check size-option form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="product_color" value="{{ $color }}" id="color{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                    <label class="form-option-label" for="color{{ $key }}">{{ $color }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($product->fabrics)
                    @php
                        $fabrics = json_decode($product->fabrics);
                    @endphp
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Fabrics:</p>
                        <div class="text-left pb-0 pt-2">
                            @foreach($fabrics as $key => $fabric)
                                <div class="form-check size-option form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="product_fabrics" value="{{ $fabric }}" id="fabrics{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                    <label class="form-option-label" for="fabrics{{ $key }}">{{ $fabric }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="prt_05 mb-4">
                    <div class="form-row mb-7">
                        <div class="col-4 col-lg-auto">
                            <div class="input-group mb-3">
                                <input class="form-control" min="1" value="1" max="{{ $product->stock }}" type="number" name="qty">
                            </div>
                        </div>
                        <div class="col-4 col-lg">
                            <!-- Submit -->
                            <button type="submit" class="btn btn-block custom-height bg-dark mb-2">
                                <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

