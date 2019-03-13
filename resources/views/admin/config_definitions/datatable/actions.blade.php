<div class="text-right text-nowrap">
    <a href="{{ route('admin.config_definitions.read', $config_definition->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fal fa-lg fa-eye"></i></a>
    @can('Update Config Definitions')
        <a href="{{ route('admin.config_definitions.update', $config_definition->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fal fa-lg fa-edit"></i></a>
    @endcan
    @can('Delete Config Definitions')
        <form method="POST" action="{{ route('admin.config_definitions.delete', $config_definition->id) }}" class="d-inline-block" novalidate data-ajax-form>
            @csrf
            @method('DELETE')
            <button type="submit" name="_submit" class="btn btn-link text-secondary p-1" title="Delete" value="reload_datatables" data-confirm>
                <i class="fal fa-lg fa-trash-alt"></i>
            </button>
        </form>
    @endcan
</div>