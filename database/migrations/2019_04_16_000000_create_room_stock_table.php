<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomStockTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('room_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('item_category_id');
            $table->integer('stock_quantity')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Room Stocks', ['Create Room Stocks', 'Read Room Stocks', 'Update Room Stocks', 'Delete Room Stocks']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('room_stocks');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Room Stocks')->delete();
    }
}