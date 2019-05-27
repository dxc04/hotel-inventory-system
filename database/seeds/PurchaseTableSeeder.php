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
            $qty = $faker->numberBetween(80, 120);
            DB::table('purchases')->insert(
                [
                    'supplier_id' => $this->getRandomSupplierId(),
                    'item_id'     => $item->id,
                    'quantity'    => $qty,
                    'status'      => 'Stocked',
                    'created_at'  => date("Y-m-d H:i:s")
                ]
            );

            DB::table('item_stocks')->insert(
                [
                    'item_id' => $item->id,
                    'stock_quantity' => $qty
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
