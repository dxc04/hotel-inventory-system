@extends('lap::layouts.auth')

@section('title', 'Update Item')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.items.update', $item->id) }}" enctype="multipart/form-data" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_name" class="col-md-2 col-form-label">Item Name</label>
                    <div class="col-md-8">
                        <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $item->item_name }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="sku" class="col-md-2 col-form-label">Sku</label>
                    <div class="col-md-8">
                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $item->sku }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="photo" class="col-md-2 col-form-label">Photo</label>
                    <div class="col-md-8">
                        <div class="custom-file">
                            <input type="file" name="photo" id="photo" class="custom-file-input">
                            <label for="photo" class="custom-file-label">Choose File</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="amount" class="col-md-2 col-form-label">Amount</label>
                    <div class="col-md-8">
                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $item->amount }}">
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