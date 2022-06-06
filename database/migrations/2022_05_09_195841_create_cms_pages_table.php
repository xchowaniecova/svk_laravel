<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('title_nav')->unique();
            $table->string('slug')->unique();
            $table->text('content1');
            $table->text('content2')->default(null)->nullable();
            $table->boolean('status')->default(0);
            $table->integer('order')->default(null)->nullable();
            $table->boolean('editable')->default(1);
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
        Schema::dropIfExists('cms_pages');
    }
}
