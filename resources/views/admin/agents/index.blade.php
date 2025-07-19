@extends('layouts.admin')

@section('title')
    Agents
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Agents</h4>
            <p class="mg-b-0">List of Agents</p>
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
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Point</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($agents))
                                @foreach($agents as $key => $agent)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            @if($agent->image)
                                                <img width="50" src="{{ asset('storage/users/'. $agent->image) }}" alt="{{  $agent->name }}">
                                            @endif
                                        </td>
                                        <td>{{ $agent->name }}</td>
                                        <td>{{ $agent->email }}</td>
                                        <td>{{ $agent->mobile }}</td>
                                        <td>{{ $agent->point }}</td>
                                        <td>{{ $agent->reference }}</td>
                                        <td>{{ $agent->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.agents.edit', $agent->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="deleteRow('{{ route('admin.agents.destroy', $agent->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
                            @if($agents->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="8">
                                        {{ $agents->links('admin.shared._paginate') }}
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
