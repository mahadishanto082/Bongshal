@extends('layouts.website')

@section('title', 'Compare Products')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Compare Products</h2>

    @if($compareItems->isEmpty())
        <div class="alert alert-info text-center">
            You have no products to compare.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>Feature</th>
                        @foreach($compareItems as $item)
                            <th>
                                <a href="{{ route('web.products.details', $item->product->slug) }}" target="_blank">
                                    {{ $item->product->name }}
                                </a>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Image</td>
                        @foreach($compareItems as $item)
                            <td>
                                <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="max-width: 120px;">
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Price</td>
                        @foreach($compareItems as $item)
                            <td>${{ number_format($item->product->price, 2) }}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Old Price</td>
                        @foreach($compareItems as $item)
                            <td>
                                @if($item->product->old_price)
                                    <s>${{ number_format($item->product->old_price, 2) }}</s>
                                @else
                                    N/A
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Availability</td>
                        @foreach($compareItems as $item)
                            <td>
                                @if($item->product->stock > 0)
                                    In Stock
                                @else
                                    Out of Stock
                                @endif
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Description</td>
                        @foreach($compareItems as $item)
                            <td>{{ Str::limit($item->product->description, 100) }}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Actions</td>
                        @foreach($compareItems as $item)
                            <td>
                                <div class="d-flex justify-content-center align-items-center" style="min-height: 150px;">
                                    <div style="width: 200px;">
                                        <form action="{{ route('web.user.compare.remove', $item->product->id) }}" method="POST" class="mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                            </button>
                                        </form>

                                        <a href="{{ route('web.products.details', $item->product->slug) }}" class="btn btn-outline-primary btn-sm w-100">
                                            <i class="fas fa-info-circle me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>

                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
