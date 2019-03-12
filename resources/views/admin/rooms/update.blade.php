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
                    <label for="room_name" class="col-md-2 col-form-label">Room Name</label>
                    <div class="col-md-8">
                        <input type="text" name="room_name" id="room_name" class="form-control" value="{{ $room->room_name }}">
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

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="created_by" class="col-md-2 col-form-label">Created By</label>
                    <div class="col-md-8">
                        <select name="created_by" id="created_by" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\User')->orderBy('name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $room->created_by ? ' selected' : '' }}>{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="description" class="col-md-2 col-form-label">Description</label>
                    <div class="col-md-8">
                        <textarea name="description" id="description" class="form-control" rows="5">{{ $room->description }}</textarea>
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