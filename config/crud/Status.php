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
    'icon' => 'fa-door-closed',

    // model attributes
    'attributes' => [

        'status_name' => [
            'primary' => true,
            'migrations' => [
                'string:status_name|unique',
            ],
            'validations' => [
                'create' => 'required|unique:statuses',
                'update' => 'required|unique:statuses,status_name,{$status->id}',
            ],
            'datatable' => [
                'title' => 'Status Name',
                'data' => 'status_name',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],

         'status_key' => [
            'migrations' => [
                'string:status_key|unique',
            ],
            'validations' => [
                'create' => 'required|unique:statuses',
                'update' => 'required|unique:statuses,status_key,{$status->id}',
            ],
            'datatable' => [
                'title' => 'Status Key',
                'data' => 'status_key',
            ],
            'input' => [
                'type' => 'text',
            ],
        ],


    ],

];
