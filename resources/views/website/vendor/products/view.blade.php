@extends('layouts.admin')

@section('_css')
   <style>


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
    Product | View
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Product | View</h4>
            <p class="mg-b-0">{{ $data->name }} - View all information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th width="20%">Type</th>
                            <th width="1%">:</th>
                            <td>{{ $data->type }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>:</th>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <th>:</th>
                            <td>{{ $data->code }}</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <th>:</th>
                            <td>{{ $data->stock }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <th>:</th>
                            <td>{{ $data->category ? $data->category->name : '--' }}</td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <th>:</th>
                            <td>{{ $data->brand ? $data->brand->name : '--' }}</td>
                        </tr>
                        <tr>
                            <th>Merchant</th>
                            <th>:</th>
                            <td>{{ $data->merchant ? $data->merchant->name : '--' }}</td>
                        </tr>
                        @if($data->type == 'Book')
                            <tr>
                                <th>Writer</th>
                                <th>:</th>
                                <td>{{ $data->writer ? $data->writer->name : '--' }}</td>
                            </tr>
                            <tr>
                                <th>First release</th>
                                <th>:</th>
                                <td>{{ $data->first_release }}</td>
                            </tr>
                            <tr>
                                <th>Language</th>
                                <th>:</th>
                                <td>{{ $data->language }}</td>
                            </tr>
                        @else
                            @if($data->size)
                                @php($sizes = json_decode($data->size, true))
                                <tr>
                                    <th>Size</th>
                                    <th>:</th>
                                    <td>
                                        @foreach($sizes as $size)
                                            <span class="badge badge-info">{{ $size }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            @if($data->color)
                                @php($colors = json_decode($data->color, true))
                                <tr>
                                    <th>Color</th>
                                    <th>:</th>
                                    <td>
                                        @foreach($colors as $color)
                                            <span class="badge badge-info">{{ $color }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            @if($data->fabrics)
                                @php($fabrics = json_decode($data->fabrics, true))
                                <tr>
                                    <th>Color</th>
                                    <th>:</th>
                                    <td>
                                        @foreach($fabrics as $fabric)
                                            <span class="badge badge-info">{{ $fabric }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Weight</th>
                                <th>:</th>
                                <td>{{ $data->weight }}</td>
                            </tr>
                            <tr>
                                <th>Warranty</th>
                                <th>:</th>
                                <td>{{ $data->warranty }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Buy Price</th>
                            <th>:</th>
                            <td>Tk. {{ $data->buy_price }}</td>
                        </tr>
                        <tr>
                            <th>Sell Price</th>
                            <th>:</th>
                            <td>Tk. {{ $data->price }}</td>
                        </tr>
                        @if($data->discount_value > 0)
                            <tr>
                                <th>Discount</th>
                                <th>:</th>
                                <td>{{ $data->discount_value }}/{{ $data->discount_type }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Point</th>
                            <th>:</th>
                            <td>Tk. {{ $data->point }}</td>
                        </tr>

                        {{-- <tr>
                            <th>Shipping in dhaka</th>
                            <th>:</th>
                            <td>Tk. {{ $data->shipping_in_dhaka }}</td>
                        </tr>
                        <tr>
                            <th>Shipping out dhaka</th>
                            <th>:</th>
                            <td>Tk. {{ $data->shipping_out_dhaka }}</td>
                        </tr> --}}
                        <tr>
                            <th>Description</th>
                            <th>:</th>
                            <td>{!! $data->description !!}</td>
                        </tr>
                        <tr>
                            <th>Delivery info</th>
                            <th>:</th>
                            <td>{!! $data->delivery_info !!}</td>
                        </tr>
                        <tr>
                            <th>Feature</th>
                            <th>:</th>
                            <td>{!! $data->feature !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td>{!! $data->status !!}</td>
                        </tr>
                        <tr>
                            <th>Image Thumb</th>
                            <th>:</th>
                            <td>
                                <img class="mt-1 img-thumbnail" width="100" src="{{ asset('storage/products/'.$data->image) }}">
                            </td>
                        </tr>
                        <tr>
                            <th>All Images</th>
                            <th>:</th>
                            <td>
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
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
