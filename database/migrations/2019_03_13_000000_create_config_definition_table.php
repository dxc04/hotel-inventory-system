<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigDefinitionTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('config_definitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('config');
            $table->string('definition')->nullable();
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Config Definitions', ['Create Config Definitions', 'Read Config Definitions', 'Update Config Definitions', 'Delete Config Definitions']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('config_definitions');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Config Definitions')->delete();
    }
}