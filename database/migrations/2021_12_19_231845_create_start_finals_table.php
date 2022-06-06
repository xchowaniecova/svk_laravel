<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_finals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section_start_id')->unsigned();
            $table->foreign('section_start_id')->references('id')->on('section_starts')->onDelete('cascade');
            $table->bigInteger('section_final_id')->unsigned();
            $table->foreign('section_final_id')->references('id')->on('section_finals')->onDelete('cascade');
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
        Schema::dropIfExists('start_finals');
    }
}
