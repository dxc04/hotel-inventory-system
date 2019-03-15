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
    'icon' => 'fa-building',

    // model attributes
    'attributes' => [

        'floor_name' => [
            'primary' => true,
            'migrations' => [
                'string:floor_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:floors',
                'update' => 'required|unique:floors,floor_name,{$floor->id}',
            ],
            'datatable' => [
                'title' => 'Floor',
                'data' => 'floor_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
