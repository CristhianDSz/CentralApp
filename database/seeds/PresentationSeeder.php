<?php

use App\Presentation;
use Illuminate\Database\Seeder;

class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentation::create([
            'name' => 'Documento de Word',
        ]);
        Presentation::create([
            'name' => 'Hoja de cálculo de Excel',
        ]);
        Presentation::create([
            'name' => 'Presentación de Power Point',
        ]);
        Presentation::create([
            'name' => 'Documento PDF',
        ]);
        Presentation::create([
            'name' => 'Formulario de Google',
        ]);
        Presentation::create([
            'name' => 'Trabajo escrito',
        ]);
        Presentation::create([
            'name' => 'Hoja de examen',
        ]);
       
    }
}
