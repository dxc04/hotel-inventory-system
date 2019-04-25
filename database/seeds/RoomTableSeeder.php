<?php

use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert(
            [
                [
                    'room_name'     => 'Room 1',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 2',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 3',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 4',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 5',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 6',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 7',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 8',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 9',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ],
                [
                    'room_name'     => 'Room 10',
                    'room_type_id'  => $this->getRandomRoomTypeId(),
                    'floor_id'      => $this->getRandomFloorId(),
                    'created_by'    => $this->getRamdomUserId()
                ]
            ]
        );
    }

    private function getRandomFloorId()
    {
        $floor = App\Floor::inRandomOrder()->first();
        return $floor->id;
    }

    private function getRandomRoomTypeId()
    {
        $room_type = App\RoomType::inRandomOrder()->first();
        return $room_type->id;
    }

    private function getRamdomUserId()
    {
        $user = App\User::inRandomOrder()->first();
        return $user->id;
    }
}
