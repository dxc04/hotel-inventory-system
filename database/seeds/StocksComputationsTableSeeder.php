<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StocksComputationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $available_stocks = App\Purchase::all();
        $item_categories = App\ItemCategory::all();
        $rooms = App\Room::all();
        $items = App\Item::all();
        
        foreach ($items as $item) {
            DB::table('stocks_computations')->insert(
                [
                    'item_id' => $item->id,
                    'quantity' => 0
                ]
            );
        }

        foreach ($rooms as $num => $room) {
            foreach ($item_categories as $cat) {
                DB::table('stocks_computations')->insert(
                    [
                        'room_id' => $room->id,
                        'item_category_id' => $cat->id,
                        'quantity' => 0
                    ]
                );
        }        
    }
}
 