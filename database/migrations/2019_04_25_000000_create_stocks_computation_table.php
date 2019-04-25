<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksComputationTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('stocks_computations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('item_category_id');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Stocks Computations', ['Create Stocks Computations', 'Read Stocks Computations', 'Update Stocks Computations', 'Delete Stocks Computations']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('stocks_computations');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Stocks Computations')->delete();
    }
}