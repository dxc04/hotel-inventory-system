<?php

use Illuminate\Database\Seeder;

class RoomStocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_categories = App\ItemCategory::all();
         
        foreach($item_categories as $cat) {
            DB::table('room_stocks')->insert(
                [
                    'room_id' => $this->getRandomRoomId(),
                    'item_category_id' => $cat->id,
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
