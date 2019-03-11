<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_number')->unique();
            $table->integer('room_type_id');
            $table->text('description');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Rooms', ['Create Rooms', 'Read Rooms', 'Update Rooms', 'Delete Rooms']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('rooms');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Rooms')->delete();
    }
}