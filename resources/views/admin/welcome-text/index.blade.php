@extends('layouts.admin')

@section('title')
    Welcome-Text | Index
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Sliders</h4>
            <p class="mg-b-0">List of WelcomeTexts</p>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($welcomeTexts))
                                @foreach($welcomeTexts as $key => $welcomeText)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        
                                        
                                        <td>{{ $welcomeText->title }}</td>
                                        
                                        <td>{{ $welcomeText->description }}</td>
                                        <td>{{ $welcomeText->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-info dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.WelcomeTexts.edit', $welcomeText->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="deleteRow('{{ route('admin.WelcomeTexts.destroy', $welcomeText->id) }}')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
                            @if($welcomeTexts->hasPages())
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
