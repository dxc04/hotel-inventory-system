<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 1; $i <= 5; $i++) {
            DB::table('suppliers')->insert(
                [
                    'supplier_name' => $faker->company,
                    'contact_number' => $faker->phoneNumber,
                    'address' => $faker->address
                ]
            );
        }
    }
}
