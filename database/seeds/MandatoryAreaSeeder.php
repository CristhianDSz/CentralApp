<?php

use App\MandatoryArea;
use Illuminate\Database\Seeder;

class MandatoryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MandatoryArea::create([
            'name' => 'Matemáticas'
        ]);
        MandatoryArea::create([
            'name' => 'Ciencias naturales y educación ambiental'
        ]);
        MandatoryArea::create([
            'name' => 'Ciencias sociales, historia, geografía, constitución política y democracia'
        ]);
        MandatoryArea::create([
            'name' => 'Educación artística'
        ]);
        MandatoryArea::create([
            'name' => 'Educación ética y en valores humanos'
        ]);
        MandatoryArea::create([
            'name' => 'Educación física, recreación y deportes'
        ]);
        MandatoryArea::create([
            'name' => 'Educación religiosa'
        ]);
        MandatoryArea::create([
            'name' => 'Humanidades, lengua castellana e idiomas extranjeros'
        ]);
        MandatoryArea::create([
            'name' => 'Tecnología e informática'
        ]);
    }
}
