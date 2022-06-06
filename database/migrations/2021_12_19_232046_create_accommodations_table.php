<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('accommodation1')->default(null)->nullable();       // 1.datum prezentacie 
            $table->string('accommodation2')->default(null)->nullable();       // 2.datum prezentacie
            $table->tinyInteger('position');        // student/doktorand/ucitel
            // $table->bigInteger('reg_id')->unsigned();
            // $table->foreign('reg_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['conf_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}
