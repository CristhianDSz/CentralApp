<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('link')->default(false);
            $table->string('content')->nullable();
            $table->unsignedBigInteger('presentation_id');
            $table->unsignedBigInteger('learning_section_id');
            $table->foreign('learning_section_id')->references('id')->on('learning_sections')->onDelete('cascade');
            $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('cascade');
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
        Schema::dropIfExists('homeworks');
    }
}
