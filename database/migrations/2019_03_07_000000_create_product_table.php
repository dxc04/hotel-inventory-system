<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->unique();
            $table->string('main_photo')->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Products', ['Create Products', 'Read Products', 'Update Products', 'Delete Products']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('products');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Products')->delete();
    }
}