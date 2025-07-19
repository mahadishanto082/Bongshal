@extends('layouts.admin')

@section('title')
    Orders Ledger
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Orders Ledger</h4>
            <p class="mg-b-0">List of Ordered Product Report</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <form>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="month" class="form-control">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}"
                                            @if((!request()->has('month') && date('m') == $i) || request()->query('month') == $i) selected @endif
                                    >
                                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="year" class="form-control">
                            @for($i = date('Y'); $i > date('Y') - 3; $i--)
                                <option value="{{ $i }}"
                                        @if((!request()->has('year') && date('Y') == $i) || request()->query('year') == $i) selected @endif
                                >
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <a href="{{ route('admin.reports.ledger') }}" class="btn btn-outline-purple">
                                <i class="icon ion-loop"></i>
                            </a>
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
                                <th>Product</th>
                                <th>QNTY</th>
                                <th>Color/Size/Fabrics</th>
                                <th>Unit Price</th>
                                <th>SubTotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Profit/Loss</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderDetails as $orderDetail)
                                <tr>
                                    <td>{{ $orderDetail->product_name }}</td>
                                    <td>{{ $orderDetail->final_quantity }}</td>
                                    <td>{{ $orderDetail->product_color ?? '--'  }} / {{ $orderDetail->product_size ?? '--' }} / {{ $orderDetail->product_fabrics ?? '--' }}</td>
                                    <td>৳{{ $orderDetail->product_unit_price }}</td>
                                    <td>৳{{ $orderDetail->sub_total }}</td>
                                    <td>৳{{ $orderDetail->discount * $orderDetail->final_quantity }}</td>
                                    <td>৳{{ $orderDetail->final_total }}</td>
                                    <td>৳{{ $orderDetail->final_total - ($orderDetail->product_buy_price * $orderDetail->final_quantity) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
