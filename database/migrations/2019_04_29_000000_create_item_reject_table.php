<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRejectTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('item_rejects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('item_category_id');
            $table->integer('item_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Item Rejects', ['Create Item Rejects', 'Read Item Rejects', 'Update Item Rejects', 'Delete Item Rejects']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('item_rejects');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Item Rejects')->delete();
    }
}