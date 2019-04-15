@extends('lap::layouts.auth')

@section('title', 'Sale')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Sales')
                <a href="{{ route('admin.sales.update', $sale->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Sales')
                <form method="POST" action="{{ route('admin.sales.delete', $sale->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $sale->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Id</div>
                <div class="col-md-8">{{ $sale->room_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Category Id</div>
                <div class="col-md-8">{{ $sale->item_category_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Quantity</div>
                <div class="col-md-8">{{ $sale->quantity }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $sale->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $sale->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection