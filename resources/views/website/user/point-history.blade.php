@extends('layouts.website')

@section('title')
    Point History
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Point History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row justify-content-center justify-content-between">
                @include('website.share.user-menu')

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <div class="row align-items-center">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 table-responsive">
                            <button type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#withdraw">Withdraw Request</button>
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Point</th>
                                    <th>Type</th>
                                    <th>Note</th>
                                    <th>Payment Type</th>
                                    <th>Payment Number</th>
                                    <th>Status</th>
                                </tr>
                                @if(count($points) > 0)
                                    @foreach($points as $key => $point)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $point->product ? $point->product->name : '--' }}</td>
                                            <td>{{ ($point->flag == 'Earn' ? '+': '-') .$point->point }}</td>
                                            <td>{{ $point->flag }}</td>
                                            <td>{{ $point->notes }}</td>
                                            <td>{{ $point->type ?? '--' }}</td>
                                            <td>{{ $point->payment_number ?? '--' }}</td>
                                            <td>{{ $point->status }}</td>
                                        </tr>
                                    @endforeach

                                    @if($points->hasPages())
                                        <tr>
                                            <td colspan="6">{{ $points->links() }}</td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>

                    </div>
                    <!-- row -->
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    @include('website.share.user-custom-feature')

    <div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="withdrawModal" aria-hidden="true">
        <div class="modal-dialog modal-xl login-pop-form" role="document">
            <div class="modal-content" id="withdrawModal">
                <div class="modal-headers">
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                        <span class="ti-close"></span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="m-0 ft-regular"> Withdraw Request</h2>
                        <p>This withdraw 1% vat included</p>
                    </div>

                    <form action="{{ route('web.user.withdrawRequest') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Your Current Pont: <b class="text-danger">{{ auth('web')->user()->point }}</b></label>
                            <input type="number" min="100" max="{{ auth('web')->user()->point }}" class="form-control" name="withdraw_point" placeholder="Point*" required>
                            @error('withdraw_point')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Select Payment Type: </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="Bkash" value="Bkash" checked>
                                <label class="form-check-label" for="Bkash">
                                    Bkash
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="Nagad" value="Nagad">
                                <label class="form-check-label" for="Nagad">
                                    Nagad
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="Recharge" value="Recharge">
                                <label class="form-check-label" for="Recharge">
                                    Recharge
                                </label>
                            </div>

                            @error('type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Payment Number: </label>
                            <input type="text"  class="form-control" name="payment_number" placeholder="Your payment number*" required>
                            @error('payment_number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('_js')
    <script>
        @error('withdraw_point')
        $("#withdraw").modal('show')
        @enderror
    </script>
@endpush
