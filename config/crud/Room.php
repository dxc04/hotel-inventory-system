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
    'icon' => 'fa-hotel',

    // model attributes
    'attributes' => [

        'room_number' => [
            'primary' => true,
            'migrations' => [
                'integer:room_number|unique',
            ],
            'validations' => [
                'create' => 'required|unique:rooms',
                'update' => 'required|unique:rooms,room_number,{$room->id}',
            ],
            'datatable' => [
                'title' => 'Room Number',
                'data' => 'room_number',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'room_type_id' => [
            'primary' => true,
            'migrations' => [
                'integer:room_type_id',
            ],
            'relationship' => [
                'room_type' => 'belongsTo:App\RoomType',
            ],
            'validations' => [
                'create' => 'required|exists:room_types,id',
                'update' => 'required|exists:room_types,id',
            ],
            'datatable' => [
                'title' => 'Room Type',
                'data' => 'room_type.room_type',
            ],
            'input' => [
                'type' => 'select',
                'options' => [
                    'app:App\RoomType|orderBy:room_type|get' => [
                        'id' => 'room_type',
                    ],
                ],
            ],
        ],

    ],

];
