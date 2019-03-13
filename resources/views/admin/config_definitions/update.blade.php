@extends('lap::layouts.auth')

@section('title', 'Update Config Definition')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.config_definitions.update', $config_definition->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="config" class="col-md-2 col-form-label">Config</label>
                    <div class="col-md-8">
                        <input type="text" name="config" id="config" class="form-control" value="{{ $config_definition->config }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="definition" class="col-md-2 col-form-label">Definition</label>
                    <div class="col-md-8">
                        <input type="text" name="definition" id="definition" class="form-control" value="{{ $config_definition->definition }}">
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