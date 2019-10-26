<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceLearningSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_learning_section', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competence_id');
            $table->unsignedBigInteger('learning_section_id');
            $table->foreign('competence_id')->references('id')->on('competences')->onDelete('cascade');
            $table->foreign('learning_section_id')->references('id')->on('competences')->onDelete('cascade');
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
        Schema::dropIfExists('competence_learning_section');
    }
}
