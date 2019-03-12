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
    'icon' => 'fa-door-open',

    // model attributes
    'attributes' => [

        'room_type' => [
            'primary' => true,
            'migrations' => [
                'string:room_type|unique',
            ],
            'validations' => [
                'create' => 'required|unique:room_types',
                'update' => 'required|unique:room_types,{room_type_id}',
            ],
            'datatable' => [
                'title' => 'Room Type',
                'data' => 'room_type',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'description' => [
            'migrations' => [
                'text:description|nullable',
            ],
            'input' => [
                'type' => 'textarea',
            ],
        ],

    ],

];
