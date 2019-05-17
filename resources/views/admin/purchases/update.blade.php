@extends('lap::layouts.auth')

@section('title', 'Update Purchase')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.purchases.update', $purchase->id) }}" novalidate data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="supplier_id" class="col-md-2 col-form-label">Supplier Id</label>
                    <div class="col-md-8">
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Supplier')->orderBy('supplier_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $purchase->supplier_id ? ' selected' : '' }}>{{ $model->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="item_id" class="col-md-2 col-form-label">Item Id</label>
                    <div class="col-md-8">
                        <select name="item_id" id="item_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Item')->orderBy('item_name')->get() as $model)
                                <option value="{{ $model->id }}"{{ $model->id == $purchase->item_id ? ' selected' : '' }}>{{ $model->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                    <div class="col-md-8">
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $purchase->quantity }}">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="status" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-8">
                        <div class="form-control-plaintext">
                            <input type="hidden" name="{attribute}">
                            @foreach(['Ordered', 'Delivered'] as $option)
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" id="status_{{ $loop->index }}" class="custom-control-input" value="{{ $option }}"{{ $option == $purchase->status ? ' checked' : '' }}>
                                    <label for="status_{{ $loop->index }}" class="custom-control-label">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>
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