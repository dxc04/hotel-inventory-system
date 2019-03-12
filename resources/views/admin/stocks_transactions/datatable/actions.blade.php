<div class="text-right text-nowrap">
    <a href="{{ route('admin.stocks_transactions.read', $stocks_transaction->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fal fa-lg fa-eye"></i></a>
    @can('Update Stocks Transactions')
        <a href="{{ route('admin.stocks_transactions.update', $stocks_transaction->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fal fa-lg fa-edit"></i></a>
    @endcan
    @can('Delete Stocks Transactions')
        <form method="POST" action="{{ route('admin.stocks_transactions.delete', $stocks_transaction->id) }}" class="d-inline-block" novalidate data-ajax-form>
            @csrf
            @method('DELETE')
            <button type="submit" name="_submit" class="btn btn-link text-secondary p-1" title="Delete" value="reload_datatables" data-confirm>
                <i class="fal fa-lg fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>