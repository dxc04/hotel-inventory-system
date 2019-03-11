<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('product_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Purchases', ['Create Purchases', 'Read Purchases', 'Update Purchases', 'Delete Purchases']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('purchases');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Purchases')->delete();
    }
}