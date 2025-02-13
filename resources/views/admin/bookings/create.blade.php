@extends('lap::layouts.auth')

@section('title', 'Create Booking')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.bookings.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="room_id" class="col-md-2 col-form-label">Room</label>
                    <div class="col-md-8">
                        <select name="room_id" id="room_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Room')->orderBy('room_name')->get() as $model)
                                <option value="{{ $model->id }}">{{ $model->room_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="guest_id" class="col-md-2 col-form-label">Guest</label>
                    <div class="col-md-8">
                        <select name="guest_id" id="guest_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Guest')->orderBy('last_name')->get() as $model)
                                <option value="{{ $model->id }}">{{ $model->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="number_of_guests" class="col-md-2 col-form-label">Number Of Guests</label>
                    <div class="col-md-8">
                        <input type="text" name="number_of_guests" id="number_of_guests" class="form-control">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="notes" class="col-md-2 col-form-label">Notes</label>
                    <div class="col-md-8">
                        <textarea name="notes" id="notes" class="form-control" rows="5"></textarea>
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
