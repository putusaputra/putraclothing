<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('order_id');
            $table->unsignedInteger('item_code');
            $table->integer('qty');
            $table->decimal('price', 10, 0);
            $table->decimal('total', 10, 0);
            $table->timestamps();

            $table->foreign('item_code')->references('item_code')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
