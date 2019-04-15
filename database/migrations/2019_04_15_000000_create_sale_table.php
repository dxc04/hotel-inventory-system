<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('item_category_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Sales', ['Create Sales', 'Read Sales', 'Update Sales', 'Delete Sales']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('sales');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Sales')->delete();
    }
}