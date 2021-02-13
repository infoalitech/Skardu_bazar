<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_dimensions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('size_id');
            $table->foreignId('parent_id')->nullable();
            $table->float('parent_value',8,2)->default(0);
            $table->boolean('default')->default(0);
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
        Schema::dropIfExists('size_dimensions');
    }
}
