<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Statuses', ['Create Statuses', 'Read Statuses', 'Update Statuses', 'Delete Statuses']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('statuses');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Statuses')->delete();
    }
}