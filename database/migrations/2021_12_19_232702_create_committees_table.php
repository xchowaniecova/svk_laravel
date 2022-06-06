<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section_final_id')->unsigned();
            $table->foreign('section_final_id')->references('id')->on('section_finals')->onDelete('cascade');
            $table->string('member_name');
            $table->string('workplace_name');
            $table->string('workplace_state');
            $table->tinyInteger('member_order');            
            $table->bigInteger('accommodation_id')->unsigned()->default(null)->nullable();
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
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
        Schema::dropIfExists('committees');
    }
}
