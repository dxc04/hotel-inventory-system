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
    'icon' => 'fa-user-circle',

    // model attributes
    'attributes' => [

        'first_name' => [
            'primary' => true,
            'migrations' => [
                'string:first_name',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'First Name',
                'data' => 'first_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'last_name' => [
            'primary' => true,
            'migrations' => [
                'string:last_name',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'datatable' => [
                'title' => 'Last Name',
                'data' => 'last_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'contact_number' => [
            'migrations' => [
                'string:contact_number',
            ],
            'datatable' => [
                'title' => 'Contact Number',
                'data' => 'contact_number',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

        'address' => [
            'migrations' => [
                'string:address',
            ],
            'datatable' => [
                'title' => 'Address',
                'data' => 'address',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

    ],

];
