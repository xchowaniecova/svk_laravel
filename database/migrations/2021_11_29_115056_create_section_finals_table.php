<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_finals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            $table->string('name');
            $table->string('name_en');
            $table->string('room')->default(null)->nullable();
            $table->string('room_online')->default(null)->nullable();
            $table->string('admin_name')->default(null)->nullable();
            $table->string('admin_email')->default(null)->nullable();
            $table->integer('type')->default(null)->nullable();         // 1-online, 2-offline, 3-hybrid
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
        Schema::dropIfExists('section_finals');
    }
}
