<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomStocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $item_categories = App\ItemCategory::all();
        $rooms = App\Room::all();

        foreach ($rooms as $num => $room) {
            $max_qty = $faker->numberBetween(2, 4);
            foreach ($item_categories as $cat) {
                $qty = $faker->numberBetween(1, $max_qty);

                DB::table('room_stock_limits')->insert(
                    [
                        'room_id' => $room->id,
                        'item_category_id' => $cat->id,
                        'stock_max' => $qty
                    ]
                );

                DB::table('room_stocks')->insert(
                    [
                        'room_id' => $room->id,
                        'item_category_id' => $cat->id,
                        'stock_quantity' => $qty
                    ]
                );
            }
        }
    }
}
 