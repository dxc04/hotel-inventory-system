<div class="text-right text-nowrap">
    <a href="{{ route('admin.guests.read', $guest->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fal fa-lg fa-eye"></i></a>
    @can('Update Guests')
        <a href="{{ route('admin.guests.update', $guest->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fal fa-lg fa-edit"></i></a>
    @endcan
    @can('Delete Guests')
        <form method="POST" action="{{ route('admin.guests.delete', $guest->id) }}" class="d-inline-block" novalidate data-ajax-form>
            @csrf
            @method('DELETE')
            <button type="submit" name="_submit" class="btn btn-link text-secondary p-1" title="Delete" value="reload_datatables" data-confirm>
                <i class="fal fa-lg fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>