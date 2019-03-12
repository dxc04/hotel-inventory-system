<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('guest_id');
            $table->integer('number_of_guests')->default(1);
            $table->timestamp('checkout_at')->nullable()->index();
            $table->text('notes');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Bookings', ['Create Bookings', 'Read Bookings', 'Update Bookings', 'Delete Bookings']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('bookings');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Bookings')->delete();
    }
}