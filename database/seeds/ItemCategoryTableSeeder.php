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
        DB::table('item_categories')->insert(
            [
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ],
                [
                    'item_id'       => $this->getRandomItemId(),
                    'category_id'   => $this->getRandomCategoryId()
                ]
            ]
        );
    }

    private function getRandomItemId()
    {
        $item = App\Item::inRandomOrder()->first();
        return $item->id;    
    }

    private function getRandomCategoryId()
    {
        $category = App\Category::inRandomOrder()->first();
        return $category->id;
    }
}
