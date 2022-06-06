<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_starts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name');
            $table->string('name_en');
            $table->boolean('final_created')->default(false);
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
        Schema::dropIfExists('section_starts');
    }
}
