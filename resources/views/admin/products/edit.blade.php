@extends('layouts.admin')

@section('_css')
    <link href="{{ asset('assets/admin/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <style>
        .note-toolbar {
            z-index: 1;
        }
        .bootstrap-tagsinput {
            width: 100%;
            min-height: 45px;
        }
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .3s ease;
            background-color: #000;
        }
        .img-sec {
            position: relative;
            width: 80px;
        }
        .img-sec:hover .overlay {
            opacity: 0.5;
        }
        .img-icon {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
            padding: 20px;
            opacity: 1;
        }
        .img-sec:hover .fa-trash {
            color: #fff;
        }

    </style>
@endsection

@section('title')
    Product | Edit
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Product | Edit</h4>
            <p class="mg-b-0">{{ $data->name }} - Edit this information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="switch-field">
                                            <input type="radio" id="General" name="type" value="General" {{ old('type', $data->type) == 'General' ? 'checked' : '' }}/>
                                            <label for="General">General Products</label>

                                            <input type="radio" id="Book" name="type" value="Book" {{ old('type', $data->type) == 'Book' ? 'checked' : '' }} />
                                            <label for="Book">Book Products</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Select Categories <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="category_id">
                                            <option value="" selected hidden disabled></option>
                                            @if(!empty($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $data->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Select brands</label>
                                        <select class="form-control select2" name="brand_id">
                                            <option value="" selected hidden disabled></option>
                                            @if(!empty($brands))
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id', $data->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('brand_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Select merchant</label>
                                        <select class="form-control select2" name="merchant_id">
                                            <option value="" selected hidden disabled></option>
                                            @if(!empty($merchants))
                                                @foreach($merchants as $merchant)
                                                    <option value="{{ $merchant->id }}" {{ old('merchant_id', $data->merchant_id) == $merchant->id ? 'selected' : '' }}>{{ $merchant->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('merchant_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Code Number<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="code" value="{{ old('code', $data->code) }}">
                                        @error('code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name', $data->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Buy Price <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="buy_price" value="{{ old('buy_price', $data->buy_price) }}">
                                        @error('buy_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Sell Price <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="price" value="{{ old('price', $data->price) }}">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-control-label">Discount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <select name="discount_type">
                                                    <option value="" hidden disabled selected>Select One</option>
                                                    <option value="Taka" {{ old('discount_type', $data->discount_type) == "Taka" ? 'selected' : '' }}>Taka</option>
                                                    <option value="Percentage" {{ old('discount_type', $data->discount_type) == "Percentage" ? 'selected' : '' }}>Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" min="0" name="discount_value" value="{{ old('discount_value', $data->discount_value) }}">
                                    </div>
                                    @error('discount_value')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Stock<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="5000" name="stock" value="{{ old('stock', $data->stock) }}">
                                        @error('stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Point</label>
                                        <input class="form-control" type="number" min="0" max="1000" name="point" value="{{ old('point', $data->point) }}">
                                        @error('point')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Shipping Dhaka City<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="shipping_in_dhaka" value="{{ old('shipping_in_dhaka', $data->shipping_in_dhaka) }}">
                                        @error('shipping_in_dhaka')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Shipping Outside Dhaka City <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="shipping_out_dhaka" value="{{ old('shipping_out_dhaka', $data->shipping_out_dhaka) }}">
                                        @error('shipping_out_dhaka')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}


                                <div class="col-md-12 BookProducts">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Select writers</label>
                                                <select class="form-control select2" name="writer_id" style="width: 100%">
                                                    <option value="" selected hidden disabled></option>
                                                    @if(!empty($writers))
                                                        @foreach($writers as $writer)
                                                            <option value="{{ $writer->id }}" {{ old('writer_id', $data->writer_id) == $writer->id ? 'selected' : '' }}>{{ $writer->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('writer_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">First Release</label>
                                                <input class="form-control" type="text" name="first_release" value="{{ old('first_release', $data->first_release) }}">
                                                @error('first_release')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Language</label>
                                                <input class="form-control" type="text" name="language" value="{{ old('language', $data->language) }}">
                                                @error('language')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 GeneralProducts">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Size</label>
                                                @if($data->size)
                                                    @php($sizes = json_decode($data->size, true))
                                                        <input class="form-control" type="text" name="size" placeholder="S, M, L, XL" value="@foreach($sizes as $size) {{ $size }}, @endforeach {{ old('size') }}" data-role="tagsinput" style="width: 100%">
                                                        @error('size')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    @else
                                                    <input class="form-control" type="text" name="size" placeholder="S, M, L, XL" value="{{ old('size') }}" data-role="tagsinput" style="width: 100%">
                                                    @error('size')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Color</label>
                                                @if($data->color)
                                                    @php($colors = json_decode($data->color, true))
                                                        <input class="form-control" type="text" name="color" placeholder="Red, Green, Yellow" value="@foreach($colors as $color) {{ $color }}, @endforeach {{ old('color') }}" data-role="tagsinput" style="width: 100%">
                                                        @error('color')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    @else
                                                    <input class="form-control" type="text" name="color" placeholder="Red, Green, Yellow" value="{{ old('color') }}" data-role="tagsinput" style="width: 100%">
                                                    @error('color')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Fabrics</label>
                                                @if($data->fabrics)
                                                    @php($fabrics = json_decode($data->fabrics, true))
                                                        <input class="form-control" type="text" name="fabrics" placeholder="Linen, Silk, Cotton" value="@foreach($fabrics as $fabric) {{ $fabric }}, @endforeach {{ old('fabrics') }}" data-role="tagsinput" style="width: 100%">
                                                        @error('fabrics')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    @else
                                                    <input class="form-control" type="text" name="fabrics" placeholder="Linen, Silk, Cotton" value="{{ old('fabrics') }}" data-role="tagsinput" style="width: 100%">
                                                    @error('fabrics')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Weight</label>
                                                <input class="form-control" type="text" name="weight" value="{{ old('weight', $data->weight) }}">
                                                @error('weight')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Warranty</label>
                                                <input class="form-control" type="text" name="warranty" value="{{ old('warranty', $data->warranty) }}">
                                                @error('warranty')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control summernote" name="description">{!! old('description', $data->description) !!}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Delivery Info</label>
                                        <input class="form-control" type="text" name="delivery_info" value="{{ old('delivery_info', $data->delivery_info) }}">
                                        @error('delivery_info')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
    <div class="form-group">
        <label class="form-control-label">Image Thumb <span class="tx-danger">*</span></label>
        
        <input class="form-control" type="file" name="image" id="imageInput" accept="image/*">

        @error('image')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Existing image --}}
        @if($data->image)
            <img id="currentImage" class="mt-1 img-thumbnail" width="80" src="{{ asset('storage/products/' . $data->image) }}">
        @endif

        {{-- Preview of newly selected image --}}
        <img id="imagePreview" class="mt-2 img-thumbnail" style="display:none;" width="80" alt="New Image Preview">
    </div>
</div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Image Details</label>
                                        <input class="form-control" type="file" name="product_images[]" multiple accept="image/*">
                                        @error('product_images')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        @if(count($data->images) > 0)
                                            <div class="mt-1">
                                                <ul class="nav nav-gray-600 flex-column flex-sm-row" role="tablist">
                                                    @foreach($data->images as $image)
                                                        <li class="nav-item img-sec">
                                                            <img class="img-thumbnail" width="80" src="{{ $image->url }}">
                                                            <div class="overlay">
                                                                <a href="javascript:void(0)" onclick="deleteRow('{{ route('admin.products.imageDelete', $image->id) }}')" class="img-icon">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Feature <small class="text-danger">(For Home Page)</small></label>
                                        <select class="form-control select2" name="feature">
                                            <option value="" selected hidden disabled></option>
                                            <option value="Yes" {{ old('feature', $data->feature) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="No" {{ old('feature', $data->feature) == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('feature')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Status</label>
                                        <select class="form-control select2" name="status">
                                            <option value="" selected hidden disabled></option>
                                            <option value="Active" {{ old('status', $data->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $data->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Sort Number</label>
                                        <input class="form-control" type="number" min="0" name="sort" value="{{ old('sort', $data->sort) }}">
                                        @error('sort')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('_js')
    <script>
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const [file] = event.target.files;
            const preview = document.getElementById("imagePreview");
            const current = document.getElementById("currentImage");

            if (file && file.type.startsWith("image/")) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";

                // Optionally hide current image
                if (current) {
                    current.style.display = "none";
                }
            }
        });
    </script>

        <script src="{{ asset('assets/admin/lib/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('assets/admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
        <script>
            let type = $('input[name=type]:checked' ).val()
            if (type === 'General') {
                $(".GeneralProducts").show()
                $(".BookProducts").hide()
            } else {
                $(".GeneralProducts").hide()
                $(".BookProducts").show()
            }

            $('input[name=type]').change(function(){
                type = $( 'input[name=type]:checked' ).val();
                if (type === 'General') {
                    $(".GeneralProducts").show()
                    $(".BookProducts").hide()
                } else {
                    $(".GeneralProducts").hide()
                    $(".BookProducts").show()
                }
            });

            // Summernote editor
            $('.summernote').summernote({
                height: 150,
                tooltip: false
            })
        </script>
@endpush

