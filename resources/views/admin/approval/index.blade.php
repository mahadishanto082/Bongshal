@extends('layouts.admin')

@section('content')
<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Approval ID</th>
                    <th>Vendor</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($approvals as $approval)
                <tr>
                <td>{{ $approval->id }}</td>
<td>{{ $approval->vendor->name ?? 'N/A' }}</td>
<td>{{ $approval->name ?? 'N/A' }}</td>
<td>
                        <span class="badge badge-{{ $approval->status == 'pending' ? 'warning' : ($approval->status == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($approval->status) }}
                        </span>
                    </td>
                    <td>
                     
                    <form action="{{ route('admin.approval.approve', $approval->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm">Approve</button>
</form>

<form action="{{ route('admin.approval.reject', $approval->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
</form>

                        <!-- Add your approve/reject buttons or actions here -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No approval requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $approvals->links() }}
        </div>
    </div>
</div>
@endsection
