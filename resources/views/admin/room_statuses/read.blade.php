@extends('lap::layouts.auth')

@section('title', 'Room Status')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Room Statuses')
                <a href="{{ route('admin.room_statuses.update', $room_status->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Room Statuses')
                <form method="POST" action="{{ route('admin.room_statuses.delete', $room_status->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $room_status->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Room</div>
                <div class="col-md-8">{{ $room_status->room_name }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Status</div>
                <div class="col-md-8">{{ implode(', ', $room_status->status) }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Notes</div>
                <div class="col-md-8">{{ $room_status->notes }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $room_status->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $room_status->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection
