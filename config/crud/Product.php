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
    'icon' => 'fa-box-full',

    // model attributes
    'attributes' => [

        'product_name' => [
            'primary' => true,
            'migrations' => [
                'string:product_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:products',
                'update' => 'required|unique:products,product_name,{$product->id}',
            ],
            'datatable' => [
                'title' => 'Product Name',
                'data' => 'product_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'photo' => [
            'migrations' => [
                'string:main_photo|nullable',
            ],
            'validations' => [
                'create' => 'nullable|image',
                'update' => 'nullable|image',
            ],
            'input' => [
                'type' => 'file',
            ],
        ],

        'quantity' => [
            'primary' => true,
            'migrations' => [
                'integer:quantity|default:0',
            ],
            'validations' => [
                'create' => 'integer',
                'update' => 'integer',
            ],
            'datatable' => [
                'title' => 'Quantity',
                'data' => 'quantity',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
