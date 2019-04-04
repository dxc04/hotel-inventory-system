@extends('lap::layouts.auth')

@section('title', 'Item Category')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Item Categories')
                <a href="{{ route('admin.item_categories.update', $item_category->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Item Categories')
                <form method="POST" action="{{ route('admin.item_categories.delete', $item_category->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $item_category->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Item Id</div>
                <div class="col-md-8">{{ $item_category->item_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Category Id</div>
                <div class="col-md-8">{{ $item_category->category_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $item_category->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $item_category->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection