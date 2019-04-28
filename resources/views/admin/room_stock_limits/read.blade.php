@extends('lap::layouts.auth')

@section('title', 'Room Stock Limit')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Room Stock Limits')
                <a href="{{ route('admin.room_stock_limits.update', $room_stock_limit->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Room Stock Limits')
                <form method="POST" action="{{ route('admin.room_stock_limits.delete', $room_stock_limit->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $room_stock_limit->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Id</div>
                <div class="col-md-8">{{ $room_stock_limit->room_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Category Id</div>
                <div class="col-md-8">{{ $room_stock_limit->item_category_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Stock Max</div>
                <div class="col-md-8">{{ $room_stock_limit->stock_max }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $room_stock_limit->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $room_stock_limit->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection