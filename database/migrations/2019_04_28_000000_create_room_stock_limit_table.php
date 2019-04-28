<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomStockLimitTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('room_stock_limits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('item_category_id');
            $table->integer('stock_max')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Room Stock Limits', ['Create Room Stock Limits', 'Read Room Stock Limits', 'Update Room Stock Limits', 'Delete Room Stock Limits']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('room_stock_limits');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Room Stock Limits')->delete();
    }
}