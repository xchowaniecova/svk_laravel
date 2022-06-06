<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conf_id')->unsigned();
            $table->foreign('conf_id')->references('id')->on('conferences')->onDelete('cascade');
            // $table->string('student_id')->default(null)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_contribution');
            $table->string('abstract_original_file');
            $table->string('abstract_storage_file');
            $table->boolean('phd')->default(false);
            $table->integer('section_start_id');
            $table->integer('section_final_id')->default(null)->nullable();
            $table->integer('program_order')->default(null)->nullable();
            // $table->string('email')->unique(); // uniqie aj s conf_id
            // $table->string('email');

            $table->unique(['conf_id', 'user_id']);

            // $table->bigInteger('faculty_id')->unsigned()->default(null)->nullable();
            // $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            // $table->string('faculty')->default(null)->nullable();
            // $table->string('university')->default(null)->nullable();
            // $table->string('hash');
            // $table->boolean('active')->default(false);
            
            $table->integer('review')->default('1');
            $table->string('iban')->default(null)->nullable();
            $table->string('swift')->default(null)->nullable();
            $table->boolean('agree_bank_account')->default('0');
            $table->boolean('agree_gdpr')->default('0');
            $table->boolean('agree_citation')->default('0');
            $table->boolean('agree_video')->default('0');
            $table->bigInteger('award_id')->unsigned()->default(null)->nullable();
            $table->foreign('award_id')->references('id')->on('awards')->onDelete('cascade');
            $table->integer('placement')->default(null)->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
