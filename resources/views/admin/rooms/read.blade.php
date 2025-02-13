@extends('lap::layouts.auth')

@section('title', 'Room')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Rooms')
                <a href="{{ route('admin.rooms.update', $room->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Rooms')
                <form method="POST" action="{{ route('admin.rooms.delete', $room->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $room->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Name</div>
                <div class="col-md-8">{{ $room->room_name }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room Type Id</div>
                <div class="col-md-8">{{ $room->room_type_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Floor Id</div>
                <div class="col-md-8">{{ $room->floor_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created By</div>
                <div class="col-md-8">{{ $room->created_by }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Description</div>
                <div class="col-md-8">{{ $room->description }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $room->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $room->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection