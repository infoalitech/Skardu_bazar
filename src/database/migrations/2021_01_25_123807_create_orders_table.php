<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->date("date");
            $table->foreignId("available_item_id");
            $table->foreignId("customer_id");
            $table->integer("quantity");
            $table->integer("unit_price");
            $table->integer("total_price");
            $table->foreignId("delivered_by");

            $table->enum("status",['draft','pending','delivered','canceled']);
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
