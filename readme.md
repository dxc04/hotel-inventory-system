## HSG Portal


## Requisites:
- MySQL
- PHP 7.13

We'll have to dockerized the setup later on

## Installation

`composer install`

`php artisan migrate`

Part of the installation uses Orchid Admin Panel to easily manage and handle entities, roles, permissions, pages

`php artisan orchid:admin admin admin@admin.com password`

Access admin via: http://localhost/dashboard

