<?php

use App\MandatoryArea;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','Administrador')->first();
        $areas = MandatoryArea::pluck('id');

        $user = User::create([
            'name' => 'Cristhian Sánchez',
            'email' => 'csanchez9@udi.edu.co',
            'password' => bcrypt('qwerty123'),
            'role_id' => $role->id
        ]);
        $user->mandatoryAreas()->attach($areas);
    }
}
