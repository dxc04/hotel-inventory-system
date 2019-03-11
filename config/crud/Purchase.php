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
                'data' => 'room.room_number',
            ],
            'input' => [
                'label' => 'Room',
                'title' => 'Room',
                'type' => 'select',
                'options' => [
                    'app:App\Room|orderBy:room_number|get' => [
                        'id' => 'room_number',
                    ],
                ],
            ],
        ],

        'product_id' => [
            'migrations' => [
                'integer:product_id',
            ],
            'relationship' => [
                'product' => 'belongsTo:App\Product',
            ],
            'validations' => [
                'create' => 'required|exists:products,id',
                'update' => 'required|exists:products,id',
            ],
            'datatable' => [
                'title' => 'Product',
                'data' => 'product.product_name',
            ],
            'input' => [
                'label' => 'Product',
                'title' => 'Product',
                'type' => 'select',
                'options' => [
                    'app:App\Product|orderBy:product_name|get' => [
                        'id' => 'product_name',
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
