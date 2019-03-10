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
    'icon' => 'fa-list-alt',

    // model attributes
    'attributes' => [

        'room_id' => [
            'primary' => true,
            'migrations' => [
                'integer:room_id|unique',
            ],
            'relationship' => [
                'room' => 'belongsTo:App\Room',
            ],
            'validations' => [
                'create' => 'required|exists:rooms,id|unique:room_statuses',
                'update' => 'required|exists:rooms,id|unique:room_statuses,room_id,{$room_status->id}',
            ],
            'datatable' => [
                'title' => 'Room Number',
                'data' => 'room.room_number',
            ],
            'input' => [
                'type' => 'select',
                'options' => [
                    'app:App\Room|orderBy:room_number|get' => [
                        'id' => 'room_number',
                    ],
                ],
            ],
        ],

        'status_id' => [
            'migrations' => [
                'integer:status_id',
            ],
            'relationship' => [
                'status' => 'belongsTo:App\Status',
            ],
            'validations' => [
                'create' => 'required|exists:statuses,id',
                'update' => 'required|exists:statuses,id',
            ],
            'datatable' => [
                'title' => 'Room Status',
                'data' => 'status.status_name',
            ],
            'input' => [
                'type' => 'select',
                'options' => [
                    'app:App\Status|orderBy:status_name|get' => [
                        'id' => 'status_name',
                    ],
                ],
            ],
        ],

    ],

];
