@extends('lap::layouts.auth')

@section('title', 'Create Stocks Transaction')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.stocks_transactions.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                    <div class="col-md-8">
                        <input type="text" name="quantity" id="quantity" class="form-control">
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="transaction_type" class="col-md-2 col-form-label">Transaction Type</label>
                    <div class="col-md-8">
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value=""></option>
                            @foreach(['Item Supplied', 'Room Replenishment', 'Purchase', 'Room Stock Reject', 'Item Stock Reject'] as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="supplier_id" class="col-md-2 col-form-label">Supplier Id</label>
                    <div class="col-md-8">
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Supplier')->orderBy('supplier_name')->get() as $model)
                                <option value="{{ $model->id }}">{{ $model->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="purchase_id" class="col-md-2 col-form-label">Purchase Id</label>
                    <div class="col-md-8">
                        <select name="purchase_id" id="purchase_id" class="form-control">
                            <option value=""></option>
                            @foreach(app('App\Purchase')->orderBy('id')->get() as $model)
                                <option value="{{ $model->id }}">{{ $model->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="notes" class="col-md-2 col-form-label">Notes</label>
                    <div class="col-md-8">
                        <textarea name="notes" id="notes" class="form-control" rows="5"></textarea>
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