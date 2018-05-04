<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('domain_id');
            $table
              ->foreign('domain_id')
              ->references('id')->on('domains')
              ->onDelete('cascade');
            $table->string('link');
            $table->string('language');
            $table->string('location');
            $table->string('location_name');
            $table->string('category');
            $table->string('area');
            $table->string('frequency');
            $table->dateTime('next_visit_time');
            $table->dateTime('last_visit_time');
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
        Schema::dropIfExists('pages');
    }
}
