<?php

use Illuminate\Database\Migrations\Migration;

class AddSeedToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $permissionSeeder = new PermissionSeeder();
       $permissionSeeder->run();
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
