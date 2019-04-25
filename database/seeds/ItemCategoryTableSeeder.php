<?php

use Illuminate\Database\Seeder;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = App\Item::all();

        foreach($items as $item) {
            DB::table('item_categories')->insert(
                [
                    'item_id'       => $item->id,
                    'category_id'   => $this->getRandomCategoryId()
                ]
            );
        }
    }

    private function getRandomCategoryId()
    {
        $category = App\Category::inRandomOrder()->first();
        return $category->id;
    }
}
