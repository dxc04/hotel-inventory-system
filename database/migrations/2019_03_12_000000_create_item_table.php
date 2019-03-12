<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name')->unique();
            $table->string('sku')->unique();
            $table->string('main_photo')->nullable();
            $table->double('amount')->default(0);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Items', ['Create Items', 'Read Items', 'Update Items', 'Delete Items']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('items');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Items')->delete();
    }
}