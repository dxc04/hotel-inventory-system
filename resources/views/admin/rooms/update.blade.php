@extends('lap::layouts.auth')

@section('title', 'Update Room')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_number" class="col-md-2 col-form-label">Room Number</label>
                    <div class="col-md-8">
                        <input type="text" name="room_number" id="room_number" class="form-control" value="{{ $room->room_number }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_type_id" class="col-md-2 col-form-label">Room Type Id</label>
                    <div class="col-md-8">
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\RoomType')->orderBy('room_type')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $room->room_type_id ? ' selected' : '' }}>{{ $model->room_type }}</option>
                            @endforeach
                        </select>
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