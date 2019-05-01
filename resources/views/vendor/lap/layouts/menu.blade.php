<li{!! request()->is('admin/dashboard') ? ' class="active"' : '' !!}>
    <a href="{{ route('admin.dashboard') }}"><i class="fal fa-fw fa-tachometer mr-3"></i>Dashboard</a>
</li>
@can('Read Item Stocks')
    <li{!! request()->is('admin/item_stocks') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.item_stocks') }}"><i class="fal fa-fw fa-box mr-3"></i>Item Stocks</a>
    </li>
@endcan
@can('Read Item Rejects')
    <li{!! request()->is('admin/item_rejects') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.item_rejects') }}"><i class="fal fa-fw fa-times-circle mr-3"></i>Item Rejects</a>
    </li>
@endcan
@can('Read Room Stock Limits')
    <li{!! request()->is('admin/room_stock_limits') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.room_stock_limits') }}"><i class="fal fa-fw fa-layer-group mr-3"></i>Room Stock Limits</a>
    </li>
@endcan
@can('Read Sales')
    <li{!! request()->is('admin/sales') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.sales') }}"><i class="fal fa-fw fa-dollar-sign mr-3"></i>Sales</a>
    </li>
@endcan
@can('Read Rooms')
    <li{!! request()->is('admin/rooms') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.rooms') }}"><i class="fal fa-fw fa-hotel mr-3"></i>Rooms</a>
    </li>
@endcan
@can('Read Floors')
    <li{!! request()->is('admin/floors') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.floors') }}"><i class="fal fa-fw fa-building mr-3"></i>Floors</a>
    </li>
@endcan
@can('Read Guests')
    <li{!! request()->is('admin/guests') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.guests') }}"><i class="fal fa-fw fa-user-circle mr-3"></i>Guests</a>
    </li>
@endcan
@can('Read Items')
    <li{!! request()->is('admin/items') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.items') }}"><i class="fal fa-fw fa-box-full mr-3"></i>Items</a>
    </li>
@endcan
@can('Read Item Categories')
    <li{!! request()->is('admin/item_categories') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.item_categories') }}"><i class="fal fa-fw fa-tag mr-3"></i>Item Categories</a>
    </li>
@endcan
@can('Read Categories')
    <li{!! request()->is('admin/categories') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.categories') }}"><i class="fal fa-fw fa-tags mr-3"></i>Categories</a>
    </li>
@endcan
@can('Read Suppliers')
    <li{!! request()->is('admin/suppliers') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.suppliers') }}"><i class="fal fa-fw fa-user-tag mr-3"></i>Suppliers</a>
    </li>
@endcan
@can('Read Purchases')
    <li{!! request()->is('admin/purchases') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.purchases') }}"><i class="fal fa-fw fa-credit-card-front mr-3"></i>Purchases</a>
    </li>
@endcan
@can('Read Room Stocks')
    <li{!! request()->is('admin/room_stocks') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.room_stocks') }}"><i class="fal fa-fw fa-ticket mr-3"></i>Room Stocks</a>
    </li>
@endcan
@can('Read Stocks Transactions')
    <li{!! request()->is('admin/stocks_transactions') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.stocks_transactions') }}"><i class="fal fa-fw fa-clipboard-list-check mr-3"></i>Stocks Transactions</a>
    </li>
@endcan
@can('Read Stocks Computations')
    <li{!! request()->is('admin/stocks_computations') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.stocks_computations') }}"><i class="fal fa-fw fa-calculator mr-3"></i>Stocks Computations</a>
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
@can('Read Bookings')
    <li{!! request()->is('admin/bookings') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.bookings') }}"><i class="fal fa-fw fa-file-user mr-3"></i>Bookings</a>
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
@can('Read Config Definitions')
    <li{!! request()->is('admin/config_definitions') ? ' class="active"' : '' !!}>
        <a href="{{ route('admin.config_definitions') }}"><i class="fal fa-fw fa-tags mr-3"></i>Config Definitions</a>
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
