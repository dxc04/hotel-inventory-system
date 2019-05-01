@extends('lap::layouts.auth')

@section('title', 'Create Item Stock')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.item_stocks.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_id" class="col-md-2 col-form-label">Item Id</label>
                    <div class="col-md-8">
                        <select name="item_id" id="item_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Item')->orderBy('item_name')->get() as $model)
                                <option value="{{ $model->id }}">{{ $model->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="stock_quantity" class="col-md-2 col-form-label">Stock Quantity</label>
                    <div class="col-md-8">
                        <input type="text" name="stock_quantity" id="stock_quantity" class="form-control">
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