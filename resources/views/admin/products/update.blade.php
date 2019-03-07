@extends('lap::layouts.auth')

@section('title', 'Update Product')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="product_name" class="col-md-2 col-form-label">Product Name</label>
                    <div class="col-md-8">
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
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
                    <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                    <div class="col-md-8">
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}">
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