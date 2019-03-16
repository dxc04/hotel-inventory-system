<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(
            [
                [
                    'status_name' => 'DND Stay Over'
                ],
                [
                    'status_name' => 'DND Due'
                ],
                [
                    'status_name' => 'Checked In'
                ],
                [
                    'status_name' => 'Restocked'
                ],
                [
                    'status_name' => 'Cleaned'
                ],
                [
                    'status_name' => 'Cleaning In Progress'
                ]
            ]
        );
    }
}
