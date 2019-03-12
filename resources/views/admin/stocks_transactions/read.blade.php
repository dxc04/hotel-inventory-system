@extends('lap::layouts.auth')

@section('title', 'Stocks Transaction')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
            @can('Update Stocks Transactions')
                <a href="{{ route('admin.stocks_transactions.update', $stocks_transaction->id) }}" class="btn btn-primary">Update</a>
            @endcan
            @can('Delete Stocks Transactions')
                <form method="POST" action="{{ route('admin.stocks_transactions.delete', $stocks_transaction->id) }}" class="d-inline-block">
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
                <div class="col-md-8">{{ $stocks_transaction->id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Quantity</div>
                <div class="col-md-8">{{ $stocks_transaction->quantity }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Transaction Type</div>
                <div class="col-md-8">{{ $stocks_transaction->transaction_type }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Supplier Id</div>
                <div class="col-md-8">{{ $stocks_transaction->supplier_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Purchase Id</div>
                <div class="col-md-8">{{ $stocks_transaction->purchase_id }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Notes</div>
                <div class="col-md-8">{{ $stocks_transaction->notes }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Created At</div>
                <div class="col-md-8">{{ $stocks_transaction->created_at }}</div>
            </div>
        </div>

        <div class="list-group-item">
            <div class="row">
                <div class="col-md-2">Updated At</div>
                <div class="col-md-8">{{ $stocks_transaction->updated_at }}</div>
            </div>
        </div>
    </div>
@endsection