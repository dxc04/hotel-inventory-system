<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number');
            $table->string('address');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Guests', ['Create Guests', 'Read Guests', 'Update Guests', 'Delete Guests']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('guests');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Guests')->delete();
    }
}