@extends('layouts.admin')

@section('title')
    Order | View
@endsection

@section('page-info')
    <div class="br-pagetitle d-print-none">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Order | View</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="card bd-0 shadow-base">
        <div class="card-body pd-30 pd-md-60">
            <div class="d-md-flex justify-content-between flex-row-reverse">
                <h1 class="mg-b-0 tx-uppercase tx-gray-400 tx-mont tx-bold">Invoice</h1>
                <div class="mg-t-25 mg-md-t-0">
                    <img width="150" src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}">
                    <address>
                        @if(getSetting() && getSetting()->address)
                            <p class="lh-1 m-0"><span class="text-dark ft-medium">Address:</span>  {{ getSetting()->address }}</p>
                        @endif
                        @if(getSetting() && getSetting()->email)
                            <p class="lh-1 m-0"><span class="text-dark ft-medium">Email:</span> {{ getSetting()->email }}</p>
                        @endif
                        @if(getSetting() && getSetting()->mobile)
                            <p class="lh-1 m-0"><span class="text-dark ft-medium">Mobile:</span> {{ getSetting()->mobile }}</p>
                        @endif
                    </address>

                </div>
            </div><!-- d-flex -->

            <div class="row mg-t-20">
                <div class="col-md">
                    <label class="tx-uppercase tx-13 tx-bold mg-b-20">Shipped To</label>
                    <h6 class="tx-inverse">{{ $order->shippingAddress->name ?? '' }}</h6>
                    <p class="lh-7">
                        {{ $order->shippingAddress->address_line ?? ''}}
                        {{ $order->shippingAddress->district ? ", {$order->shippingAddress->district}" : '' }} <br>
                        Tel No: {{ $order->shippingAddress->phone ?? '' }}<br>
                        @if($order->shippingAddress->email ?? '')
                        Email: {{ $order->shippingAddress->email }}
                    </p>
                       @endif
                </div><!-- col -->

                <div class="col-md">
                    <label class="tx-uppercase tx-13 tx-bold mg-b-20">Billed To</label>
                    <h6 class="tx-inverse">{{ $order->billingAddress->name ?? '' }}</h6>
                    <p class="lh-7">
                        {{ $order->billingAddress->address_line ?? ''}}
                        {{ $order->billingAddress->district ? ", {$order->billingAddress->district}" : '' }} <br>
                        Tel No: {{ $order->billingAddress->phone ?? '' }}<br>
                        @if($order->billingAddress->email ?? '')
                        Email: {{ $order->billingAddress->email }}
                    </p>
                       @endif
                </div><!-- col -->


                @if($order->refAgent)
                    <div class="col-md">
                        <label class="tx-uppercase tx-13 tx-bold mg-b-20">Ref. Agent</label>
                        <h6 class="tx-inverse">{{ $order->refAgent->name ?? '' }}</h6>
                        <p class="lh-7">
                            Email: {{ $order->refAgent->email ?? ''}} <br>
                            Reference: {{ $order->refAgent->reference ?? ''}} <br>
                            Tel No: {{ $order->refAgent->mobile ?? '' }}
                        </p>
                    </div><!-- col -->
                @endif

                <div class="col-md">
                    <label class="tx-uppercase tx-13 tx-bold mg-b-20">Invoice Information</label>
                    <p class="d-flex justify-content-between mg-b-5">
                        <span>Invoice No</span>
                        <span>INV-{{ $order->id }}</span>
                    </p>
                    <p class="d-flex justify-content-between mg-b-5">
                        <span>Order ID</span>
                        <span>#{{ $order->id }}</span>
                    </p>
                    <p class="d-flex justify-content-between mg-b-5">
                        <span>Issue Date:</span>
                        <span>{{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                    </p>
                    <p class="d-flex justify-content-between mg-b-5">
                        <span>Due Date:</span>
                        <span>{{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                    </p>
                </div><!-- col -->
            </div><!-- row -->

            <div class="table-responsive mg-t-40">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="wd-20p">Product</th>
                        <th class="tx-center">QNTY</th>
                        <th class="tx-center">Color/Size/Fabrics</th>
                        <th class="tx-right">Unit Price</th>
                        <th class="tx-right">SubTotal</th>
                        <th class="tx-right">Discount</th>
                        <th class="tx-right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->product_name }}</td>
                        <td class="tx-center">{{ $orderDetail->final_quantity }}</td>
                        <td class="tx-center">{{ $orderDetail->product_color ?? '--'  }} / {{ $orderDetail->product_size ?? '--' }} / {{ $orderDetail->product_fabrics ?? '--' }}</td>
                        <td class="tx-right">৳{{ $orderDetail->product_unit_price }}</td>
                        <td class="tx-right">৳{{ $orderDetail->sub_total }}</td>
                        <td class="tx-right">৳{{ $orderDetail->discount * $orderDetail->final_quantity }}</td>
                        <td class="tx-right">৳{{ $orderDetail->final_total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" rowspan="5" class="valign-middle">

                        </td>
                        <td class="tx-right">Sub-Total</td>
                        <td colspan="3" class="tx-right">৳{{ $order->sub_total }}</td>
                    </tr>
                    <tr>
                        <td class="tx-right">Shipping Charge</td>
                        <td colspan="3"  class="tx-right">৳{{ $order->total_shipping_charge }}</td>
                    </tr>
                    <tr>
                        <td class="tx-right">Discount</td>
                        <td colspan="3" class="tx-right">-৳{{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
                        <td colspan="3" class="tx-right"><h4 class="tx-teal tx-bold tx-lato">৳{{ $order->final_total }}</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->

            <hr class="mg-b-60">

            <a href="javascript:void(0)" onclick="print()" class="btn btn-info btn-block d-print-none">Print</a>

        </div><!-- card-body -->
    </div><!-- card -->
@endsection
