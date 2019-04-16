@extends('lap::layouts.auth')

@section('title', 'Create Stocks Transaction')
@section('child-content')
    <h2>@yield('title')</h2>

    <form method="POST" action="{{ route('admin.stocks_transactions.create') }}" novalidate data-ajax-form>
        @csrf

        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group row mb-0">
                    <label for="transaction_key" class="col-md-2 col-form-label">Transaction Key</label>
                    <div class="col-md-8">
                        <select name="transaction_key" id="transaction_key" class="form-control">
                            <option value=""></option>
                            @foreach(['sale' => 'Sale', 'purchase' => 'Purchase', 'replenishment' => 'Room Replenishment', 'room-stock-reject' => 'Room Stock Reject', 'item-stock-reject' => 'Item Stock Reject'] as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

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
                    <label for="remote_id" class="col-md-2 col-form-label">Remote Id</label>
                    <div class="col-md-8">
                        <input type="text" name="remote_id" id="remote_id" class="form-control">
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