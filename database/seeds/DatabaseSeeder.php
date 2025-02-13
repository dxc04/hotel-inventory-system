<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            FloorsTableSeeder::class,
            RoomTypesTableSeeder::class,
            StatusesTableSeeder::class,
            ItemsTableSeeder::class,
            CategoriesTableSeeder::class,
            RoomTableSeeder::class,
            ItemCategoryTableSeeder::class,
            SupplierTableSeeder::class,
            PurchaseTableSeeder::class,
            RoomStocksTableSeeder::class,
        ]);
    }
}
