<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomStatusTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unique();
            $table->integer('status_id');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Room Statuses', ['Create Room Statuses', 'Read Room Statuses', 'Update Room Statuses', 'Delete Room Statuses']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('room_statuses');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Room Statuses')->delete();
    }
}