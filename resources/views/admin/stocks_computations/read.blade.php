@extends('lap::layouts.auth')

@section('title', 'Stocks Computation')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Stocks Computations')
                <a href="{{ route('admin.stocks_computations.update', $stocks_computation->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Stocks Computations')
                <form method="POST" action="{{ route('admin.stocks_computations.delete', $stocks_computation->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $stocks_computation->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Id</div>
                <div class="col-md-8">{{ $stocks_computation->room_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Category Id</div>
                <div class="col-md-8">{{ $stocks_computation->item_category_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $stocks_computation->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $stocks_computation->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection