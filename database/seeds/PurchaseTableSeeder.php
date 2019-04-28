<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $items = App\Item::all();
         
        foreach($items as $item) {
            DB::table('purchases')->insert(
                [
                    'supplier_id' => $this->getRandomSupplierId(),
                    'item_id' => $item->id,
                    'quantity' => $faker->numberBetween(80, 120)
                ]
            );
        }
    }

    private function getRandomSupplierId()
    {
        $supplier = App\Supplier::inRandomOrder()->first();
        return $supplier->id;
    }
}
