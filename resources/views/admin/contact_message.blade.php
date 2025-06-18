@extends('layouts.admin')

@section('title')
    Contact Message
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-email"></i>
        <div>
            <h4> Contact Message</h4>
            <p class="mg-b-0">List Of contact message</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <form action="{{ route('admin.contactMessage.index') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ request()->key }}" name="key" placeholder="Name, Email, Mobile">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                            <a href="{{ route('admin.contactMessage.index') }}" class="btn btn-outline-purple"><i class="icon ion-loop"></i></a>
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
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($messages))
                                @foreach($messages as $key => $message)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->mobile }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>{{ date('d-m-Y', strtotime($message->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a onclick="deleteRow('{{ route('admin.contactMessage.destroy', $message->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
                            @if($messages->hasPages())
                                <tfoot>
                                <tr>
                                    <td colspan="8">
                                        {{ $messages->appends(request()->all())->links('admin.shared._paginate') }}
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
