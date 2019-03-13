@extends('lap::layouts.auth')

@section('title', 'Config Definition')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Config Definitions')
                <a href="{{ route('admin.config_definitions.update', $config_definition->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Config Definitions')
                <form method="POST" action="{{ route('admin.config_definitions.delete', $config_definition->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $config_definition->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Config</div>
                <div class="col-md-8">{{ $config_definition->config }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Definition</div>
                <div class="col-md-8">{{ $config_definition->definition }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $config_definition->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $config_definition->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection