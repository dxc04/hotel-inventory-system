<li{!! request()->is('admin/dashboard') ? ' class="active"' : '' !!}>
    <a href="{{ route('admin.dashboard') }}"><i class="fal fa-fw fa-tachometer mr-3"></i>Dashboard</a>
</li>
@can('Read Suppliers')
    <li{!! request()->is('admin/suppliers') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.suppliers') }}"><i class="fal fa-fw fa-link mr-3"></i>Suppliers</a>
    </li>
@endcan
@can('Read Products')
    <li{!! request()->is('admin/products') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.products') }}"><i class="fal fa-fw fa-box-full mr-3"></i>Products</a>
    </li>
@endcan
@can('Read Roles')
    <li{!! request()->is('admin/roles') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.roles') }}"><i class="fal fa-fw fa-shield-alt mr-3"></i>Roles</a>
    </li>
@endcan
@can('Read Users')
    <li{!! request()->is('admin/users') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.users') }}"><i class="fal fa-fw fa-user mr-3"></i>Users</a>
    </li>
@endcan
@can('Read Activity Logs')
    <li{!! request()->is('admin/activity_logs') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.activity_logs') }}"><i class="fal fa-fw fa-file-alt mr-3"></i>Activity Logs</a>
    </li>
@endcan
@can('Read Docs')
    <li{!! request()->is('admin/docs') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.docs') }}"><i class="fal fa-fw fa-book mr-3"></i>Docs</a>
    </li>
@endcan
@can('Update Settings')
    <li{!! request()->is('admin/settings') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.settings') }}"><i class="fal fa-fw fa-cog mr-3"></i>Settings</a>
    </li>
@endcan