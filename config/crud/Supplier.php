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
    'icon' => 'fa-link',

    // model attributes
    'attributes' => [

        'supplier_name' => [
            'primary' => true,
            'migrations' => [
                'string:supplier_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:suppliers',
                'update' => 'required|unique:suppliers,supplier_name,{$supplier->id}',
            ],
            'datatable' => [
                'title' => 'Supplier Name',
                'data' => 'supplier_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
