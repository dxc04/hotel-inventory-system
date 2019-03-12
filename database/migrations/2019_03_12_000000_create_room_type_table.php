<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypeTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('room_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_type')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Room Types', ['Create Room Types', 'Read Room Types', 'Update Room Types', 'Delete Room Types']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('room_types');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Room Types')->delete();
    }
}