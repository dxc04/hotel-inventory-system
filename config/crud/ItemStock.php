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
    'icon' => 'fa-box',

    // model attributes
    'attributes' => [

        'item_id' => [
            'migrations' => [
                'integer:item_id',
            ],
            'relationship' => [
                'item' => 'belongsTo:App\Item',
            ],
            'validations' => [
                'create' => 'required|exists:items,id',
                'update' => 'required|exists:items,id',
            ],
            'datatable' => [
                'title' => 'Item',
                'data' => 'item.id',
            ],
            'input' => [
                'label' => 'Item',
                'title' => 'Item',
                'type' => 'select',
                'options' => [
                    'app:App\Item|orderBy:item_name|get' => [
                        'id' => 'item_name',
                    ],
                ],
            ],
        ],

        'stock_quantity' => [
            'migrations' => [
                'integer:stock_quantity|default:1',
            ],
            'validations' => [
                'create' => 'required|integer',
                'update' => 'required|',
            ],
            'datatable' => [
                'title' => 'Stock Quantity',
                'data' => 'stock_quantity',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];