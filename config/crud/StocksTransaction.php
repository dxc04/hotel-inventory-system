<?php

return [

    // paths & files used for generating
    'paths' => [
        'stubs' => 'vendor/kjjdion/laravel-admin-panel/resources/stubs/crud/default',
        'controller' => 'app/Http/Controllers/Admin',
        'model' => 'app',
        'migrations' => 'database/migrations',
        'views' => 'resources/views/admin',
        'menu' => 'resources/views/vendor/lap/layouts/menu.blade.php',
        'routes' => 'routes/web.php',
    ],

    // menu icon (fontawesome class)
    'icon' => 'fa-clipboard-list-check',

    // model attributes
    'attributes' => [

        'transaction_key' => [
            'migrations' => [
                'string:transaction_key',
            ],
            'validations' => [
                'create' => 'required|in:sale,purchase,restock,room-stock-reject,item-stock-reject',
                'update' => 'required|in:sale,purchase,restock,room-stock-reject,item-stock-reject',
            ],
            'datatable' => [
                'title' => 'Transaction Type',
                'data' => 'transaction_key',
            ],
            'input' => [
                'type' => 'select',
                'options' => [
                    'sale' => 'Sale',
                    'purchase' => 'Purchase',
                    'restock' => 'Room Restock',
                    'room-stock-reject' => 'Room Stock Reject',
                    'item-stock-reject' => 'Item Stock Reject'
                ],
            ],
        ],

        'quantity' => [
            'primary' => true,
            'migrations' => [
                'integer:quantity',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Quantity',
                'data' => 'quantity',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'remote_id' => [
            'primary' => true,
            'migrations' => [
                'integer:remote_id',
            ],
            'validations' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
            ],
            'datatable' => [
                'title' => 'Remote ID',
                'data' => 'remote_id',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'notes' => [
            'migrations' => [
                'text:notes',
            ],
            'validations' => [
                'create' => 'required|min:250',
                'update' => 'required|min:250',
            ],
            'input' => [
                'type' => 'textarea',
            ],
        ],

    ],

];
