@extends('lap::layouts.auth')

@section('title', 'Update Category')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="category_name" class="col-md-2 col-form-label">Category Name</label>
                    <div class="col-md-8">
                        <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="key" class="col-md-2 col-form-label">Key</label>
                    <div class="col-md-8">
                        <input type="text" name="key" id="key" class="form-control" value="{{ $category->key }}">
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