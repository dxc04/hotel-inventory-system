@extends('lap::layouts.auth')

@section('title', 'Create Status')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.statuses.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="status_name" class="col-md-2 col-form-label">Status Name</label>
                    <div class="col-md-8">
                        <input type="text" name="status_name" id="status_name" class="form-control">
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