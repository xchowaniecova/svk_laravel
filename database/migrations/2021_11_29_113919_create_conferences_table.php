<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null)->nullable();
            $table->integer('order');
            $table->date('conf_date')->default(null)->nullable();
            $table->date('date_start');
            $table->date('date_end');
            $table->date('reg_start');
            $table->date('reg_end');
            $table->date('reg_late_start')->default(null)->nullable();
            $table->date('reg_late_end')->default(null)->nullable();
            $table->string('hash')->default(null)->nullable();
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
        Schema::dropIfExists('conferences');
    }
}
