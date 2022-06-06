<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->after('password')->nullable();
            $table->string('student_id')->after('role')->default(null)->nullable();
            $table->string('notification')->after('student_id')->default(null)->nullable();
            $table->string('notification_poster')->after('notification')->default(null)->nullable();
            $table->bigInteger('faculty_id')->unsigned()->after('notification_poster')->default(null)->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->string('faculty')->after('faculty_id')->default(null)->nullable();
            $table->string('university')->after('faculty')->default(null)->nullable();
            // $table->string('iban')->default(null)->nullable();
            // $table->string('swift')->default(null)->nullable();
            // $table->boolean('agree_bank_account')->default('0');
            // $table->boolean('agree_gdpr')->default('0');
            // $table->boolean('agree_citation')->default('0');
            // $table->boolean('agree_video')->default('0');           
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
            //
        });
    }
}
