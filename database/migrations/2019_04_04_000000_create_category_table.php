<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('key');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Categories', ['Create Categories', 'Read Categories', 'Update Categories', 'Delete Categories']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('categories');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Categories')->delete();
    }
}