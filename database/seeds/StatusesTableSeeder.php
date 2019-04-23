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
                    'status_name' => 'DND Stayover',
                    'status_key'  => 'dnd_stayover'
                ],
                [
                    'status_name' => 'DND Due-Out',
                    'status_key'  => 'dnd_due_out'
                ],
                [
                    'status_name' => 'Checked In',
                    'status_key'  => 'checked_in'
                ],
                [
                    'status_name' => 'Restocked',
                    'status_key'  => 'restocked'
                ],
                [
                    'status_name' => 'Sale',
                    'status_key'  => 'sale'
                ],
                [
                    'status_name' => 'Cleaning In Progress',
                    'status_key'  => 'cleaning_in_progress'
                ]
            ]
        );
    }
}
