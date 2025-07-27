@extends('layouts.admin')

@section('title')
    Banner | List
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Banners</h4>
            <p class="mg-b-0">List of Banners</p>
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
                                    <th>Title</th>
                                    <th>Sub title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($banners->count())
                                    @foreach($banners as $key => $banner)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($banner->image)
                                                    <img width="50" src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}">
                                                @endif
                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td>{{ $banner->sub_title ?? '--' }}</td>
                                            <td>{{ $banner->description ?? '--' }}</td>
                                            <td>{{ $banner->status }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.banners.edit', $banner->id) }}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a onclick="deleteRow('{{ route('admin.banners.destroy', $banner->id) }}')" class="dropdown-item" href="javascript:void(0)">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No data found</td>
                                    </tr>
                                @endif
                            </tbody>
                            @if($banners->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            {{ $banners->links('admin.shared._paginate') }}
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
