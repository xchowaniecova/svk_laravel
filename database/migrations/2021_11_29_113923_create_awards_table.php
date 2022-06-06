<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name');
            $table->string('name_short')->default(null)->nullable();
            $table->string('url')->default(null)->nullable();
            $table->integer('amount');
            $table->string('requirement');
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('awards');
    }
}
