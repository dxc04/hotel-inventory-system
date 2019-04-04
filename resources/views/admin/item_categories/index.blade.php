@extends('lap::layouts.auth')

@section('title', 'Item Categories')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Create Item Categories')
                <a href="{{ route('admin.item_categories.create') }}" class="btn btn-primary">Create Item Category</a>
            @endcan
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $html->table() !!}
        </div>
    </div>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush