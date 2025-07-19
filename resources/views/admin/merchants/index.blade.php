@extends('layouts.admin')

@section('title')
    Merchants
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Merchants</h4>
            <p class="mg-b-0">List of Merchants</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <div class="bd bd-gray-300 rounded table-responsive">
                        <table class="table my-table table-hover mg-b-0">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Feature</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($merchants))
                                @foreach($merchants as $key => $merchant)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            @if($merchant->image)
                                                <img width="50" src="{{ asset('storage/merchants/'. $merchant->image) }}" alt="{{  $merchant->name }}">
                                            @endif
                                        </td>
                                        <td>{{ $merchant->name }}</td>
                                        <td>{{ $merchant->description }}</td>
                                        <td>{{ $merchant->status }}</td>
                                        <td>{{ $merchant->feature }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.merchants.edit', $merchant->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="deleteRow('{{ route('admin.merchants.destroy', $merchant->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No data
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            @if($merchants->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        {{ $merchants->links('admin.shared._paginate') }}
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
