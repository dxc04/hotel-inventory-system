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

        'supplier_id' => [
            'migrations' => [
                'integer:supplier_id',
            ],
            'relationship' => [
                'supplier' => 'belongsTo:App\Supplier',
            ],
            'validations' => [
                'create' => 'required|exists:suppliers,id',
                'update' => 'required|exists:suppliers,id',
            ],
            'datatable' => [
                'title' => 'Supplier',
                'data' => 'supplier.supplier_name',
            ],
            'input' => [
                'label' => 'Supplier',
                'title' => 'Supplier',
                'type' => 'select',
                'options' => [
                    'app:App\Supplier|orderBy:supplier_name|get' => [
                        'id' => 'supplier_name',
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
                'data' => 'quantity',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'status' => [
            'migrations' => [
                'text:status|nullable',
            ],
            'datatable' => [
                'title' => 'Status',
                'data' => 'status',
            ],
            'input' => [
                'type' => 'radio',
                'options' => ['Ordered', 'Delivered'],
            ],            
        ]

    ],

];
