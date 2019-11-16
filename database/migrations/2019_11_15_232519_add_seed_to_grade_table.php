<?php

use Illuminate\Database\Migrations\Migration;

class AddSeedToGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $seeder = new GradeSeeder();
       $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
