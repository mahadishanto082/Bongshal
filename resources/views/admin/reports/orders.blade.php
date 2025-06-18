@extends('layouts.admin')

@section('title')
    Orders Report
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Orders</h4>
            <p class="mg-b-0">List of Orders Report</p>
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
                            <select class="form-control" name="report_type">
                                <option
                                    value="order_amount" {{ !request()->exists('order_amount') || request()->report_type == 'order_amount' ? 'selected' : '' }}
                                >
                                    Total Order Amount
                                </option>

                                <option
                                    value="order_number" {{ request()->report_type == 'order_number' ? 'selected' : '' }}
                                >
                                    Total Order Number
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="year" class="form-control">
                            @for($i = date('Y'); $i > date('Y') - 3; $i--)
                                <option value="{{ $i }}"
                                        @if(request()->query('year') == $i) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <a href="{{ route('admin.reports.orders') }}" class="btn btn-outline-purple">
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
                                <th></th>
                                <th>January</th>
                                <th>February</th>
                                <th>March</th>
                                <th>April</th>
                                <th>May</th>
                                <th>June</th>
                                <th>July</th>
                                <th>August</th>
                                <th>September</th>
                                <th>October</th>
                                <th>November</th>
                                <th>December</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 1; $i < 32; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    @for ($j = 1; $j < 13; $j++)
                                        <td>{{ isset($orders[$j][$i]) ? $orders[$j][$i] : 0 }}</td>
                                        @php
                                            $monthData[$j][] = isset($orders[$j][$i]) ? $orders[$j][$i] : 0;
                                        @endphp
                                    @endfor
                                </tr>
                            @endfor
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                @foreach ($monthData as $monthDatum)
                                    <th>{{ array_sum($monthDatum) }}</th>
                                @endforeach
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
