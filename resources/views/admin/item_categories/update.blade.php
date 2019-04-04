@extends('lap::layouts.auth')

@section('title', 'Update Item Category')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.item_categories.update', $item_category->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_id" class="col-md-2 col-form-label">Item Id</label>
                    <div class="col-md-8">
                        <select name="item_id" id="item_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Item')->orderBy('item_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $item_category->item_id ? ' selected' : '' }}>{{ $model->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="category_id" class="col-md-2 col-form-label">Category Id</label>
                    <div class="col-md-8">
                        <select name="category_id" id="category_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Category')->orderBy('category_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $item_category->category_id ? ' selected' : '' }}>{{ $model->category_name }}</option>
                            @endforeach
                        </select>
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