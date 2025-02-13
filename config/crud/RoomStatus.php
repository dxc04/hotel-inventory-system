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
                'integer:room_id',
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
                'data' => 'room.room_name',
            ],
            'input' => [
                'label' => 'Room',
                'type' => 'select',
                'options' => [
                    'app:App\Room|orderBy:room_name|get' => [
                        'id' => 'room_name',
                    ],
                ],
            ],
        ],

        'status' => [
            'migrations' => [
                'text:status|nullable',
            ],
            'datatable' => [
                'title' => 'Status',
                'data' => 'status',
            ],
            'casts' => 'array',
            'input' => [
                'type' => 'checkbox',
                'options' => [
                    'app:App\Status|orderBy:status_name|get' => [
                        'id' => 'status_name',
                    ],
                ],
            ],
        ],

        'notes' => [
            'migrations' => [
                'text:notes|nullable',
            ],
            'validations' => [
                'create' => 'required|min:10',
                'update' => 'required|min:10',
            ],
            'input' => [
                'type' => 'textarea',
            ],
        ],

    ],

];
