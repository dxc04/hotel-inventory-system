<?php

use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert(
            [
                [
                    'room_type' => 'Standard'
                ],
                [
                    'room_type' => 'Deluxe'
                ],
                [
                    'room_type' => 'Family'
                ],

           ]
        );

    }
}
