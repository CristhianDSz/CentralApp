<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create(['name' => 'Primero']);
        Grade::create(['name' => 'Segundo']);
        Grade::create(['name' => 'Tercero']);
        Grade::create(['name' => 'Cuarto']);
        Grade::create(['name' => 'Quinto']);
        Grade::create(['name' => 'Sexto']);
        Grade::create(['name' => 'Séptimo']);
        Grade::create(['name' => 'Octavo']);
        Grade::create(['name' => 'Noveno']);
        Grade::create(['name' => 'Décimo']);
        Grade::create(['name' => 'Undécimo']);
    }
}
