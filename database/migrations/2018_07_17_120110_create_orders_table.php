<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned()->nullable()->default(null);
            $table->foreign('table_id')->references('id')->on('tables')->onUpdate('cascade')->onDelete('set null');
            $table->integer('waiter_id')->unsigned()->nullable()->default(null);
            $table->foreign('waiter_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->boolean('isOpen');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
