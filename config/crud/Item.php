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

        'item_name' => [
            'primary' => true,
            'migrations' => [
                'string:item_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:items',
                'update' => 'required|unique:items,item_name,{$item->id}',
            ],
            'datatable' => [
                'title' => 'Item Name',
                'data' => 'item_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'sku' => [
            'migrations' => [
                'string:sku|unique',
            ],
            'validations' => [
                'create' => 'required|unique:items',
                'update' => 'required|unique:items,sku,{$item->sku}',
            ],
            'datatable' => [
                'title' => 'SKU',
                'data' => 'sku',
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

        'amount' => [
            'migrations' => [
                'double:amount|default:0',
            ],
            'validations' => [
                'create' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'update' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            ],
            'datatable' => [
                'title' => 'Amount',
                'data' => 'amount',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
