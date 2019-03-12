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
    'icon' => 'fa-credit-card-front',

    // model attributes
    'attributes' => [

        'room_id' => [
            'migrations' => [
                'integer:room_id',
            ],
            'relationship' => [
                'room' => 'belongsTo:App\Room',
            ],
            'validations' => [
                'create' => 'required|exists:rooms,id',
                'update' => 'required|exists:rooms,id',
            ],
            'datatable' => [
                'title' => 'Room',
                'data' => 'room.room_name',
            ],
            'input' => [
                'label' => 'Room',
                'title' => 'Room',
                'type' => 'select',
                'options' => [
                    'app:App\Room|orderBy:room_name|get' => [
                        'id' => 'room_name',
                    ],
                ],
            ],
        ],

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
                'data' => 'item.item_name',
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

        'quantity' => [
            'migrations' => [
                'integer:quantity|default:1',
            ],
            'validations' => [
                'create' => 'required|integer',
                'update' => 'required|',
            ],
            'datatable' => [
                'title' => 'Quantity',
                'data' => 'purchase.quantity',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
