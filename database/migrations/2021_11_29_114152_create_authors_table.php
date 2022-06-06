<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reg_id')->unsigned();
            $table->foreign('reg_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->bigInteger('title1_id')->unsigned()->default(null)->nullable();
            $table->foreign('title1_id')->references('id')->on('first_titles')->onDelete('cascade');
            $table->string('title1')->default(null)->nullable();
            $table->string('name');
            $table->string('surname');
            $table->bigInteger('title2_id')->unsigned()->default(null)->nullable();
            $table->foreign('title2_id')->references('id')->on('second_titles')->onDelete('cascade');
            $table->string('title2')->default(null)->nullable();
            $table->boolean('presentation')->default(false);
            $table->tinyInteger('order')->default(null)->nullable();
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
        Schema::dropIfExists('authors');
    }
}
