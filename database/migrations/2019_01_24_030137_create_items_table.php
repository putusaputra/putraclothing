<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_code');
            $table->string('item_category');
            $table->string('item_name');
            $table->string('item_preview');
            $table->string('item_material');
            $table->string('item_size');
            $table->string('item_src');
            $table->string('item_alt');
            $table->string('item_title');
            $table->mediumText('item_keywords');
            $table->unsignedDecimal('item_price', 10, 0);
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
        Schema::dropIfExists('items');
    }
}
