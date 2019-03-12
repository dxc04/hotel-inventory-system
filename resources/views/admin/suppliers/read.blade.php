@extends('lap::layouts.auth')

@section('title', 'Supplier')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Suppliers')
                <a href="{{ route('admin.suppliers.update', $supplier->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Suppliers')
                <form method="POST" action="{{ route('admin.suppliers.delete', $supplier->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $supplier->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Supplier Name</div>
                <div class="col-md-8">{{ $supplier->supplier_name }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Contact Number</div>
                <div class="col-md-8">{{ $supplier->contact_number }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Address</div>
                <div class="col-md-8">{{ $supplier->address }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $supplier->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $supplier->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection