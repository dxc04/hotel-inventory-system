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
    'icon' => 'fa-tag',

    // model attributes
    'attributes' => [

        'category_name' => [
            'primary' => true,
            'migrations' => [
                'string:category_name',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Category Name',
                'data' => 'category_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],
        'key' => [
            'migrations' => [
                'string:key',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Key',
                'data' => 'key',
            ],
            'input' => [
                'type' => 'text',
            ],           
        ]

    ],

];