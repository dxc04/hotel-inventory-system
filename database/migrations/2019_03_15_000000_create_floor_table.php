<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('floor_name')->unique();
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Floors', ['Create Floors', 'Read Floors', 'Update Floors', 'Delete Floors']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('floors');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Floors')->delete();
    }
}