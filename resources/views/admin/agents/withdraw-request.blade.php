@extends('layouts.admin')

@section('title')
    Agents | Withdraw Request
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Agents | Withdraw Request</h4>
            <p class="mg-b-0">List of Withdraw Request</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="row pb-3">
                <div class="col-3 font-weight-bold">
                   <a href="{{ route('admin.agents.withdrawRequest') }}" class="btn btn-outline-warning btn-sm btn-block">Pending</a>
                </div>
                <div class="col-3 font-weight-bold">
                   <a href="{{ route('admin.agents.withdrawRequest') }}?status=Complete" class="btn btn-outline-success btn-sm btn-block">Complete</a>
                </div>
                <div class="col-3 font-weight-bold">
                   <a href="{{ route('admin.agents.withdrawRequest') }}?status=Failed" class="btn btn-outline-danger btn-sm btn-block">Cancel</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="bd bd-gray-300 rounded table-responsive">

                        <table class="table my-table table-hover mg-b-0">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Agent</th>
                                <th>Point</th>
                                <th>Payment Type</th>
                                <th>Payment Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($withdraws) > 0)
                                @foreach($withdraws as $key => $withdraw)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            {{ $withdraw->user->name }}<br>
                                            {{ $withdraw->user->mobile }}
                                        </td>
                                        <td>{{ $withdraw->point }}</td>
                                        <td>{{ $withdraw->type }}</td>
                                        <td>{{ $withdraw->payment_number }}</td>
                                        <td>{{ $withdraw->status }}</td>
                                        <td>
                                            @if($withdraw->status == 'Pending')
                                                <button onclick="showUpdateStatusModal('{{ route('admin.agents.withdrawRequestUpdate', $withdraw->id) }}')" class="btn btn-sm btn-info">Update</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No data
                                    </td>
                                </tr>
                            @endif
                            </tbody>

                            @if($withdraws->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {{ $withdraws->appends(request()->input())->links('admin.shared._paginate') }}
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


    <div id="update-status-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bd-0 tx-14">
                <form method="post" id="update-status-form">
                    @csrf
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update status</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label class="form-control-label">Select status<span class="tx-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                <option value="Complete">Complete</option>
                                <option value="Failed">Canceled</option>
                            </select>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Update</button>
                        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('_js')
    <script>
        function showUpdateStatusModal(route) {
            const form = document.getElementById('update-status-form');
            form.action = route;
            $('#update-status-modal').modal('show');
        }
    </script>
@endpush
