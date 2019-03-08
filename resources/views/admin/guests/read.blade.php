@extends('lap::layouts.auth')

@section('title', 'Guest')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Guests')
                <a href="{{ route('admin.guests.update', $guest->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Guests')
                <form method="POST" action="{{ route('admin.guests.delete', $guest->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $guest->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">First Name</div>
                <div class="col-md-8">{{ $guest->first_name }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Last Name</div>
                <div class="col-md-8">{{ $guest->last_name }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $guest->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $guest->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection