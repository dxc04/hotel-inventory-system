@extends('lap::layouts.auth')

@section('title', 'Room Type')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Room Types')
                <a href="{{ route('admin.room_types.update', $room_type->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Room Types')
                <form method="POST" action="{{ route('admin.room_types.delete', $room_type->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $room_type->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Type</div>
                <div class="col-md-8">{{ $room_type->room_type }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Description</div>
                <div class="col-md-8">{{ $room_type->description }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $room_type->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $room_type->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection