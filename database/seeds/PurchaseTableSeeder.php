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
                    'room_id' => $this->getRandomRoomId(),
                    'item_id' => $item->id,
                    'quantity' => $faker->numberBetween(1, 100)
                ]
            );
        }
    }

    private function getRandomRoomId()
    {
        $room = App\Room::inRandomOrder()->first();
        return $room->id;
    }
}
