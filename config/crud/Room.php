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

        'room_name' => [
            'primary' => true,
            'migrations' => [
                'string:room_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:rooms',
                'update' => 'required|unique:rooms,room_name,{$room->id}',
            ],
            'datatable' => [
                'title' => 'Room Name',
                'data' => 'room_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'room_type_id' => [
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
                'label' => 'Room Type',
                'type' => 'select',
                'options' => [
                    'app:App\RoomType|orderBy:room_type|get' => [
                        'id' => 'room_type',
                    ],
                ],
            ],
        ],

        'room_floor_name' => [
            'migrations' => [
                'string:room_floor_name',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Floor',
                'data' => 'room_floor_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'created_by' => [
            'migrations' => [
                'integer:created_by',
            ],
            'relationship' => [
                'user' => 'belongsTo:App\User',
            ],
            'validations' => [
                'create' => 'required|exists:users,id',
                'update' => 'required|exists:users,id',
            ],
            'datatable' => [
                'title' => 'Created By',
                'data' => 'user.name',
            ],
            'input' => [
                'type' => 'select',
                'options' => [
                    'app:App\User|orderBy:name|get' => [
                        'id' => 'name',
                    ],
                ],
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
