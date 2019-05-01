<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemStockTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('stock_quantity')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Item Stocks', ['Create Item Stocks', 'Read Item Stocks', 'Update Item Stocks', 'Delete Item Stocks']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('item_stocks');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Item Stocks')->delete();
    }
}