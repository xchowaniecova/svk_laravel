<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_committees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->bigInteger('title1_id')->unsigned();
            $table->foreign('title1_id')->references('id')->on('first_titles')->onDelete('cascade');
            $table->bigInteger('title2_id')->unsigned();
            $table->foreign('title2_id')->references('id')->on('second_titles')->onDelete('cascade');
            $table->integer('ais_id');
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
        Schema::dropIfExists('program_committees');
    }
}
