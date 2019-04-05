<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert(
            [
                [
                    'item_name' => 'Potato Chips',
                    'sku'       => '10001',
                    'amount'    => 3.0
                ],
                [
                    'item_name' => 'Cola',
                    'sku'       => '10002',
                    'amount'    => 2.0
                ],
                [
                    'item_name' => 'Beer',
                    'sku'       => '10003',
                    'amount'    => 2.5
                ],
                [
                    'item_name' => 'Orange Juice',
                    'sku'       => '10004',
                    'amount'    => 2.2
                ],
                [
                    'item_name' => 'Lemonade',
                    'sku'       => '10005',
                    'amount'    => 1.5
                ],
                [
                    'item_name' => 'Clubhouse Sandwitch',
                    'sku'       => '10006',
                    'amount'    => 2.0
                ],
                [
                    'item_name' => 'Grilled Cheese',
                    'sku'       => '10007',
                    'amount'    => 1.8
                ],
                [
                    'item_name' => 'Cheetos Puffs',
                    'sku'       => '10008',
                    'amount'    => 1.0
                ],
                [
                    'item_name' => 'Hershey Milk Chocolate',
                    'sku'       => '10009',
                    'amount'    => 1.0
                ],
                [
                    'item_name' => 'Sparkling Water',
                    'sku'       => '10010',
                    'amount'    => 1.0
                ]
            ]
        );
    }
}
