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
    'icon' => 'fa-file-user',

    // model attributes
    'attributes' => [

        'room_id' => [
            'migrations' => [
                'integer:room_id',
            ],
            'relationship' => [
                'room' => 'belongsTo:App\Room',
            ],
            'validations' => [
                'create' => 'required|exists:rooms,id',
                'update' => 'required|exists:rooms,id',
            ],
            'datatable' => [
                'title' => 'Room',
                'data' => 'room.room_number',
            ],
            'input' => [
                'label' => 'Room',
                'type' => 'select',
                'options' => [
                    'app:App\Room|orderBy:room_number|get' => [
                        'id' => 'room_number',
                    ],
                ],
            ],
        ],

        'guest_id' => [
            'migrations' => [
                'integer:guest_id',
            ],
            'relationship' => [
                'guest' => 'belongsTo:App\guest',
            ],
            'validations' => [
                'create' => 'required|exists:guests,id',
                'update' => 'required|exists:guests,id',
            ],
            'datatable' => [
                'title' => 'guest',
                'data' => "guest.last_name || ', ' || guest.first_name",
            ],
            'input' => [
                'label' => 'guest',
                'type' => 'select',
                'options' => [
                    'app:App\guest|orderBy:last_name|get' => [
                        'last_name' => 'last_name',
                        'first_name' => 'first_name',
                    ],
                ],
            ],
        ],

        'number_of_guests' => [
            'primary' => true,
            'migrations' => [
                'integer:number_of_guests|default:1',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required'
            ],
            'datatable' => [
                'title' => 'Number of Guests',
                'data' => 'number_of_guests',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'checkout_at' => [
            'migrations' => [
                'timestamp:checkout_at|nullable|index',
            ],
            'user_timezone' => true,
            'datatable' => [
                'title' => 'Checkout At',
                'data' => 'checkout_at',
            ],
        ],

        'notes' => [
            'migrations' => [
                'text:notes',
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
