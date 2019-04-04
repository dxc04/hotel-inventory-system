<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoryTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('item_categories', function (Blueprint $table) {
            $table->increments('id');
            
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Item Categories', ['Create Item Categories', 'Read Item Categories', 'Update Item Categories', 'Delete Item Categories']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('item_categories');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Item Categories')->delete();
    }
}