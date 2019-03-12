<li{!! request()->is('admin/dashboard') ? ' class="active"' : '' !!}>
    <a href="{{ route('admin.dashboard') }}"><i class="fal fa-fw fa-tachometer mr-3"></i>Dashboard</a>
</li>
@can('Read Bookings')
    <li{!! request()->is('admin/bookings') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.bookings') }}"><i class="fal fa-fw fa-file-user mr-3"></i>Bookings</a>
    </li>
@endcan
@can('Read Guests')
    <li{!! request()->is('admin/guests') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.guests') }}"><i class="fal fa-fw fa-user-circle mr-3"></i>Guests</a>
    </li>
@endcan
@can('Read Rooms')
    <li{!! request()->is('admin/rooms') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.rooms') }}"><i class="fal fa-fw fa-hotel mr-3"></i>Rooms</a>
    </li>
@endcan
@can('Read Items')
    <li{!! request()->is('admin/items') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.items') }}"><i class="fal fa-fw fa-box-full mr-3"></i>Items</a>
    </li>
@endcan
@can('Read Purchases')
    <li{!! request()->is('admin/purchases') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.purchases') }}"><i class="fal fa-fw fa-credit-card-front mr-3"></i>Purchases</a>
    </li>
@endcan
@can('Read Stocks Transactions')
    <li{!! request()->is('admin/stocks_transactions') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.stocks_transactions') }}"><i class="fal fa-fw fa-clipboard-list-check mr-3"></i>Stocks Transactions</a>
    </li>
@endcan
@can('Read Room Statuses')
    <li{!! request()->is('admin/room_statuses') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.room_statuses') }}"><i class="fal fa-fw fa-list-alt mr-3"></i>Room Statuses</a>
    </li>
@endcan
@can('Read Room Types')
    <li{!! request()->is('admin/room_types') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.room_types') }}"><i class="fal fa-fw fa-door-open mr-3"></i>Room Types</a>
    </li>
@endcan
@can('Read Statuses')
    <li{!! request()->is('admin/statuses') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.statuses') }}"><i class="fal fa-fw fa-door-closed mr-3"></i>Statuses</a>
    </li>
@endcan
@can('Read Suppliers')
    <li{!! request()->is('admin/suppliers') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.suppliers') }}"><i class="fal fa-fw fa-user-tag mr-3"></i>Suppliers</a>
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
