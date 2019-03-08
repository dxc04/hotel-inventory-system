@extends('lap::layouts.auth')

@section('title', 'Update Room Status')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.room_statuses.update', $room_status->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="status_id" class="col-md-2 col-form-label">Status Id</label>
                    <div class="col-md-8">
                        <select name="status_id" id="status_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Status')->orderBy('status_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $room_status->status_id ? ' selected' : '' }}>{{ $model->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_id" class="col-md-2 col-form-label">Room Id</label>
                    <div class="col-md-8">
                        <select name="room_id" id="room_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Room')->orderBy('room_number')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $room_status->room_id ? ' selected' : '' }}>{{ $model->room_number }}</option>
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