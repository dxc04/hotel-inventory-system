<?php

use Illuminate\Database\Seeder;

class FloorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total_floors = 10;

        for ($i = 1; $i <= $total_floors; $i++) {
            DB::table('floors')->insert([
                'floor_name' => $i    
            ]);
        }

    }
}
