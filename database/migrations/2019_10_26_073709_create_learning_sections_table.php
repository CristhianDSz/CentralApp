<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('context');
            $table->unsignedBigInteger('ova_id');
            $table->foreign('ova_id')->references('id')->on('ovas')->onDelete('cascade');
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
        Schema::dropIfExists('learning_sections');
    }
}
