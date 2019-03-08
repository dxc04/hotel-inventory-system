@extends('lap::layouts.auth')

@section('title', 'Create Guest')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.guests.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="first_name" class="col-md-2 col-form-label">First Name</label>
                    <div class="col-md-8">
                        <input type="text" name="first_name" id="first_name" class="form-control">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="last_name" class="col-md-2 col-form-label">Last Name</label>
                    <div class="col-md-8">
                        <input type="text" name="last_name" id="last_name" class="form-control">
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