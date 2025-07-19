@extends('layouts.admin')

@section('title')
    Writers
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Writers</h4>
            <p class="mg-b-0">List of writers</p>
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
                                <th>Bio</th>
                                <th>Feature</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($writers))
                                @foreach($writers as $key => $writer)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            @if($writer->image)
                                                <img width="50" src="{{ asset('storage/writers/'. $writer->image) }}" alt="{{  $writer->name }}">
                                            @endif
                                        </td>
                                        <td>{{ $writer->name }}</td>
                                        <td>{{ $writer->bio }}</td>
                                        <td>{{ $writer->status }}</td>
                                        <td>{{ $writer->feature }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.writers.edit', $writer->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="deleteRow('{{ route('admin.writers.destroy', $writer->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
                            @if($writers->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        {{ $writers->links('admin.shared._paginate') }}
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
