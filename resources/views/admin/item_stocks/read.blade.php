@extends('lap::layouts.auth')

@section('title', 'Item Stock')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Item Stocks')
                <a href="{{ route('admin.item_stocks.update', $item_stock->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Item Stocks')
                <form method="POST" action="{{ route('admin.item_stocks.delete', $item_stock->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $item_stock->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Id</div>
                <div class="col-md-8">{{ $item_stock->item_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Stock Quantity</div>
                <div class="col-md-8">{{ $item_stock->stock_quantity }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $item_stock->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $item_stock->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection