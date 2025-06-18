@extends('layouts.admin')

@section('title')
    Products
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Products</h4>
            <p class="mg-b-0">List of Products</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">

            <form action="{{ route('admin.products.index') }}" method="get">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ request()->key }}" name="key" placeholder="Name Or Code">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control select2" name="category">
                                <option value="" selected hidden disabled></option>
                                @if(!empty($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control select2" name="brand">
                                <option value="" selected hidden disabled></option>
                                @if(!empty($brands))
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request()->brand == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ request()->price_from }}" name="price_from" placeholder="Price From">
                                <input type="text" class="form-control" value="{{ request()->price_to }}" name="price_to" placeholder="Price To">
                            </div><!-- input-group -->
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <select class="form-control select2" name="item_number">
                                <option value="" selected hidden disabled></option>
                                <option value="20" {{ request()->item_number == '20' ? 'selected' : '' }}>20</option>
                                <option value="30" {{ request()->item_number == '30' ? 'selected' : '' }}>30</option>
                                <option value="50" {{ request()->item_number == '50' ? 'selected' : '' }}>50</option>
                                <option value="80" {{ request()->item_number == '80' ? 'selected' : '' }}>80</option>
                                <option value="100" {{ request()->item_number == '100' ? 'selected' : '' }}>100</option>
                                <option value="150" {{ request()->item_number == '150' ? 'selected' : '' }}>150</option>
                                <option value="200" {{ request()->item_number == '200' ? 'selected' : '' }}>200</option>
                                <option value="500" {{ request()->item_number == '500' ? 'selected' : '' }}>500</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-purple"><i class="icon ion-loop"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="bd bd-gray-300 rounded table-responsive">
                        <table class="table my-table table-hover mg-b-0">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tablecontents">
                            @if(count($products))
                                @foreach($products as $key => $product)
                                    <tr class="row1" data-id="{{ $product->id }}">
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            @if($product->image)
                                                <img width="50" src="{{ asset('storage/products/'. $product->image) }}" alt="{{  $product->name }}">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->category ? $product->category->name : '--' }}</td>
                                        <td>{{ $product->brand ? $product->brand->name : '--' }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{ route('admin.products.show', $product->id) }}"><i class="fa fa-eye"></i> View</a>
                                                    <a onclick="deleteRow('{{ route('admin.products.destroy', $product->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        No data
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            @if($products->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="9">
                                        {{ $products->appends(request()->all())->links('admin.shared._paginate') }}
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('_js')
    <script src="{{ asset('assets/admin/js/jquery-ui.js') }}"></script>
    <script>
        $(function () {
            $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                axis: 'y',
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];

                $('tr.row1').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1,
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.products.sortable') }}",
                    data: {
                        order:order,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        if (response.status === true) {
                            location.reload();
                        } else {
                            console.log(response.message)
                        }
                    }
                });

            }
        });
    </script>

@endpush
