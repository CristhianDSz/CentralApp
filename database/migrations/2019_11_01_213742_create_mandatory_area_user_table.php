<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMandatoryAreaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandatory_area_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mandatory_area_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('mandatory_area_id')->references('id')->on('mandatory_areas')->onDelete('cascade');
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
        Schema::dropIfExists('mandatory_area_user');
    }
}
