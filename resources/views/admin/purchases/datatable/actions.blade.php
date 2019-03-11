<div class="text-right text-nowrap">
    <a href="{{ route('admin.purchases.read', $purchase->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fal fa-lg fa-eye"></i></a>
    @can('Update Purchases')
        <a href="{{ route('admin.purchases.update', $purchase->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fal fa-lg fa-edit"></i></a>
    @endcan
    @can('Delete Purchases')
        <form method="POST" action="{{ route('admin.purchases.delete', $purchase->id) }}" class="d-inline-block" novalidate data-ajax-form>
            @csrf
            @method('DELETE')
            <button type="submit" name="_submit" class="btn btn-link text-secondary p-1" title="Delete" value="reload_datatables" data-confirm>
                <i class="fal fa-lg fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>