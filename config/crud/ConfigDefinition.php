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
    'icon' => 'fa-tags',

    // model attributes
    'attributes' => [

        'config' => [
            'primary' => true,
            'migrations' => [
                'string:config',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Config',
                'data' => 'config',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'definition' => [
            'primary' => true,
            'migrations' => [
                'string:definition|nullable',
            ],
            'datatable' => [
                'title' => 'Definition',
                'data' => 'definition',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
