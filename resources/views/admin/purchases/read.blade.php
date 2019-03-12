@extends('lap::layouts.auth')

@section('title', 'Purchase')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Purchases')
                <a href="{{ route('admin.purchases.update', $purchase->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Purchases')
                <form method="POST" action="{{ route('admin.purchases.delete', $purchase->id) }}" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary" data-confirm>Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="list-group">
        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">ID</div>
                <div class="col-md-8">{{ $purchase->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Id</div>
                <div class="col-md-8">{{ $purchase->room_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Id</div>
                <div class="col-md-8">{{ $purchase->item_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Quantity</div>
                <div class="col-md-8">{{ $purchase->quantity }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $purchase->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $purchase->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection