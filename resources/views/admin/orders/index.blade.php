@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Orders</h4>
            <p class="mg-b-0">List of Orders</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">

            <form action="{{ route('admin.orders.index') }}" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control select2" name="status">
                                <option value="">All</option>
                                <option value="Pending" {{ request()->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ request()->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Ready to Ship" {{ request()->status == 'Ready to Ship' ? 'selected' : '' }}>Ready to Ship</option>
                                <option value="Shipped" {{ request()->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ request()->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Returned" {{ request()->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                                <option value="Canceled" {{ request()->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="Failed" {{ request()->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-purple"><i class="icon ion-loop"></i></a>
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
                                <th>Order Number</th>
                                <th>SubTotal</th>
                                <th>Discount</th>
                                <th>Shipping Charge</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders))
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>৳{{ $order->sub_total }}</td>
                                        <td>৳{{ $order->discount }}</td>
                                        <td>৳{{ $order->total_shipping_charge }}</td>
                                        <td>৳{{ $order->final_total }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#"
                                                   role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.orders.show', $order->id) }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>

                                                    @if($order->status != 'Delivered')
                                                        <a class="dropdown-item" onclick="showUpdateStatusModal('{{ route('admin.orders.update', $order->id) }}', '{{ $order->status }}')" href="javascript:void(0)">
                                                            <i class="fa fa-edit"></i> Update status
                                                        </a>

                                                        <a onclick="deleteRow('{{ route('admin.orders.destroy', $order->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                    @endif
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
                            @if($orders->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="9">
                                        {{ $orders->appends(request()->all())->links('admin.shared._paginate') }}
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

    <!-- SMALL MODAL -->
    <div id="update-status-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
                <form method="post" id="update-status-form">
                    @csrf
                    @method('put')

                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update status</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label class="form-control-label">Select status<span class="tx-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror"
                                    name="status"
                                    id="status"
                            >
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Ready to Ship">Ready to Ship</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Returned">Returned</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Failed">Failed</option>
                            </select>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit"
                                class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                            Save changes
                        </button>

                        <button type="button"
                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('_js')
    <script !src="">
        function showUpdateStatusModal(route, status) {
            const form = document.getElementById('update-status-form');
            form.action = route;

            // Get the select element
            const statusSelect = document.getElementById('status');

            // Loop through each option to find the one that matches the status parameter
            for (let i = 0; i < statusSelect.options.length; i++) {
                if (statusSelect.options[i].value === status) {
                    // Set the selected attribute for the matching option
                    statusSelect.options[i].selected = true;
                    break; // Stop the loop once a match is found
                }
            }

            $('#update-status-modal').modal('show');
        }
    </script>
@endpush
