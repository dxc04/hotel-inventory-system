@extends('lap::layouts.auth')

@section('title', 'Item Reject')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Item Rejects')
                <a href="{{ route('admin.item_rejects.update', $item_reject->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Item Rejects')
                <form method="POST" action="{{ route('admin.item_rejects.delete', $item_reject->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $item_reject->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Id</div>
                <div class="col-md-8">{{ $item_reject->room_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Category Id</div>
                <div class="col-md-8">{{ $item_reject->item_category_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Id</div>
                <div class="col-md-8">{{ $item_reject->item_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Quantity</div>
                <div class="col-md-8">{{ $item_reject->quantity }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $item_reject->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $item_reject->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection