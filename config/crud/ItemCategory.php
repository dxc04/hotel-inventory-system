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

        'item_id' => [
            'primary' => true,
            'migrations' => [
                'integer:item_id',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'relationship' => [
                'item' => 'belongsTo:App\Item',
            ],
            'datatable' => [
                'title' => 'Item',
                'data' => 'item.item_name',
            ],
            'input' => [
                'label' => 'Item',
                'type' => 'select',
                'options' => [
                    'app:App\Item|orderBy:item_name|get' => [
                        'id' => 'item_name',
                    ],
                ],
            ],
        ],

        'category_id' => [
            'migrations' => [
                'integer:category_id',
            ],
            'validations' => [
                'create' => 'required',
                'update' => 'required',
            ],
            'relationship' => [
                'category' => 'belongsTo:App\Category',
            ],
            'datatable' => [
                'title' => 'Category',
                'data' => 'category.category_name',
            ],
            'input' => [
                'label' => 'Category',
                'type' => 'select',
                'options' => [
                    'app:App\Category|orderBy:category_name|get' => [
                        'id' => 'category_name',
                    ],
                ],
            ],
        ],

    ],

];
