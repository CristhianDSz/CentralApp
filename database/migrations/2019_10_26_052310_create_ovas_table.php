<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ovas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('period');
            $table->string('theme');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('mandatory_area_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            $table->foreign('mandatory_area_id')->references('id')->on('mandatory_areas')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ovas');
    }
}
