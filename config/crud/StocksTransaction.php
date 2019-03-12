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

        'transaction_type' => [
            'migrations' => [
                'string:transaction_type',
            ],
            'validations' => [
                'create' => 'required|in:Item Supplied,Room Replenishment,Purchase,Reject',
                'update' => 'required|in:Item Supplied,Room Replenishment,Purchase,Reject',
            ],
            'datatable' => [
                'title' => 'Transaction Type',
                'data' => 'transactio_type',
            ],
            'input' => [
                'type' => 'select',
                'options' => ['Item Supplied','Room Replenishment','Purchase','Room Stock Reject', 'Item Stock Reject'],
            ],
        ],

        'supplier_id' => [
            'primary' => true,
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
                'type' => 'select',
                'options' => [
                    'app:App\Supplier|orderBy:supplier_name|get' => [
                        'id' => 'supplier_name',
                    ],
                ],
            ],
        ],

        'purchase_id' => [
            'primary' => true,
            'migrations' => [
                'integer:purchase_id',
            ],
            'relationship' => [
                'purchase' => 'belongsTo:App\Purchase',
            ],
            'validations' => [
                'create' => 'required|exists:purchases,id',
                'update' => 'required|exists:purchases,id',
            ],
            'datatable' => [
                'title' => 'Purchase',
                'data' => 'purchase.purchase_id',
            ],
            'input' => [
                'label' => 'Purchase',
                'type' => 'select',
                'options' => [
                    'app:App\Purchase|orderBy:id|get' => [
                        'id' => 'id',
                    ],
                ],
            ],
        ],

        'notes' => [
            'migrations' => [
                'text:notes',
            ],
            'validations' => [
                'create' => 'required|min:10',
                'update' => 'required|min:10',
            ],
            'input' => [
                'type' => 'textarea',
            ],
        ],

    ],

];
