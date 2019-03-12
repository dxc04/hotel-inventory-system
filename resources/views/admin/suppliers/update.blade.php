@extends('lap::layouts.auth')

@section('title', 'Update Supplier')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.suppliers.update', $supplier->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="supplier_name" class="col-md-2 col-form-label">Supplier Name</label>
                    <div class="col-md-8">
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="contact_number" class="col-md-2 col-form-label">Contact Number</label>
                    <div class="col-md-8">
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $supplier->contact_number }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="address" class="col-md-2 col-form-label">Address</label>
                    <div class="col-md-8">
                        <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}">
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