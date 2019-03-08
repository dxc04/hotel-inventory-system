@extends('lap::layouts.auth')

@section('title', 'Create Room Type')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.room_types.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_type" class="col-md-2 col-form-label">Room Type</label>
                    <div class="col-md-8">
                        <input type="text" name="room_type" id="room_type" class="form-control">
                    </div>
                </div>
            </div>

            <div class="list-group-item bg-light text-left text-md-right pb-1">
                <button type="submit" name="_submit" class="btn btn-primary mb-2" value="reload_page">Save</button>
                <button type="submit" name="_submit" class="btn btn-primary mb-2" value="redirect">Save &amp; Go Back</button>
            </div>
        </div>
    </form>
@endsection