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
                    <td>{{ $approval->product->name ?? 'N/A' }}</td>
                    <td>
                        <span class="badge badge-{{ $approval->status == 'pending' ? 'warning' : ($approval->status == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($approval->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.approval.show', $approval->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.approval.edit', $approval->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.approval.destroy', $approval->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this approval request?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <!-- You can add approve/reject buttons here if needed -->

                        <a href="{{ route('admin.approval.approve', $approval->id) }}" class="btn btn-success btn-sm">Approve</a>
                        <a href="{{ route('admin.approval.reject', $approval->id) }}" class="btn btn-danger btn-sm">Reject</a>
                        
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
