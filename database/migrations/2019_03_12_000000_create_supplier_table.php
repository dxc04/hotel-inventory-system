<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_name')->unique();
            $table->string('contact_number');
            $table->string('address');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Suppliers', ['Create Suppliers', 'Read Suppliers', 'Update Suppliers', 'Delete Suppliers']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('suppliers');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Suppliers')->delete();
    }
}