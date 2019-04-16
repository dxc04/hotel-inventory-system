<div class="text-right text-nowrap">
    <a href="{{ route('admin.room_stocks.read', $room_stock->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fal fa-lg fa-eye"></i></a>
    @can('Update Room Stocks')
        <a href="{{ route('admin.room_stocks.update', $room_stock->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fal fa-lg fa-edit"></i></a>
    @endcan
    @can('Delete Room Stocks')
        <form method="POST" action="{{ route('admin.room_stocks.delete', $room_stock->id) }}" class="d-inline-block" novalidate data-ajax-form>
            @csrf
            @method('DELETE')
            <button type="submit" name="_submit" class="btn btn-link text-secondary p-1" title="Delete" value="reload_datatables" data-confirm>
                <i class="fal fa-lg fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>