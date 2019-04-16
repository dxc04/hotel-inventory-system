<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTransactionTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('stocks_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_key');
            $table->integer('quantity');
            $table->integer('remote_id');
            $table->text('notes');
            $table->timestamps();
        });

        // add permissions
        app(config('lap.models.permission'))->createGroup('Stocks Transactions', ['Create Stocks Transactions', 'Read Stocks Transactions', 'Update Stocks Transactions', 'Delete Stocks Transactions']);
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('stocks_transactions');

        // delete permissions
        app(config('lap.models.permission'))->where('group', 'Stocks Transactions')->delete();
    }
}