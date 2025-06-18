@extends('layouts.admin')

@section('title')
    Sliders
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Sliders</h4>
            <p class="mg-b-0">List of Sliders</p>
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
                                <th>Category</th>
                                <th>Title</th>
                                <th>Sub title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($sliders))
                                @foreach($sliders as $key => $slider)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            @if($slider->image)
                                                <img width="50" src="{{ asset('storage/sliders/'. $slider->image) }}" alt="{{  $slider->title }}">
                                            @endif
                                        </td>
                                        <td>{{ $slider->category ? $slider->category->name : '--' }}</td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->sub_title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>{{ $slider->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.sliders.edit', $slider->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="deleteRow('{{ route('admin.sliders.destroy', $slider->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">
                                        No data
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            @if($sliders->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="8">
                                        {{ $sliders->links('admin.shared._paginate') }}
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
