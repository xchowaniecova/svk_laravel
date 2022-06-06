<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitle1IdAndTitle2IdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name')->nullable();
            $table->bigInteger('title1_id')->after('surname')->unsigned()->default(null)->nullable();
            $table->foreign('title1_id')->references('id')->on('first_titles')->onDelete('cascade');
            $table->bigInteger('title2_id')->after('title1_id')->unsigned()->default(null)->nullable();
            $table->foreign('title2_id')->references('id')->on('second_titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['first_titles']);
            $table->dropForeign(['second_titles']);
        });
    }
}
