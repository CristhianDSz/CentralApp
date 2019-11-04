<?php

use Illuminate\Database\Migrations\Migration;

class AddSeedToMandatoryAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $areaSeeder = new MandatoryAreaSeeder();
        $areaSeeder->run();
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
