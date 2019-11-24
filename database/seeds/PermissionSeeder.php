<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'edit school',
            'description' => 'Editar información de institución'
        ]);
        Permission::create([
            'name' => 'create users',
            'description' => 'Crear usuarios'
        ]);
        Permission::create([
            'name' => 'update users',
            'description' => 'Actualizar usuarios'
        ]);
        Permission::create([
            'name' => 'delete users',
            'description' => 'Eliminar usuarios'
        ]);
        Permission::create([
            'name' => 'create roles',
            'description' => 'Crear roles'
        ]);
        Permission::create([
            'name' => 'update roles',
            'description' => 'Actualizar roles'
        ]);
        Permission::create([
            'name' => 'delete roles',
            'description' => 'Eliminar roles'
        ]);
        Permission::create([
            'name' => 'create grades',
            'description' => 'Crear grados'
        ]);
        Permission::create([
            'name' => 'update grades',
            'description' => 'Actualizar grados'
        ]);
        Permission::create([
            'name' => 'delete grades',
            'description' => 'Eliminar grados'
        ]);
        Permission::create([
            'name' => 'create classes',
            'description' => 'Crear clases'
        ]);
        Permission::create([
            'name' => 'update classes',
            'description' => 'Actualizar clases'
        ]);
        Permission::create([
            'name' => 'delete classes',
            'description' => 'Eliminar clases'
        ]);
        Permission::create([
            'name' => 'create mandatory_areas',
            'description' => 'Crear áreas'
        ]);
        Permission::create([
            'name' => 'update mandatory_areas',
            'description' => 'Actualizar áreas'
        ]);
        Permission::create([
            'name' => 'delete mandatory_areas',
            'description' => 'Eliminar áreas'
        ]);
        Permission::create([
            'name' => 'create subjects',
            'description' => 'Crear asignaturas'
        ]);
        Permission::create([
            'name' => 'update subjects',
            'description' => 'Actualizar asignaturas'
        ]);
        Permission::create([
            'name' => 'delete subjects',
            'description' => 'Eliminar asignaturas'
        ]);
        Permission::create([
            'name' => 'create components',
            'description' => 'Crear componentes'
        ]);
        Permission::create([
            'name' => 'update components',
            'description' => 'Actualizar componentes'
        ]);
        Permission::create([
            'name' => 'delete components',
            'description' => 'Eliminar componentes'
        ]);
        Permission::create([
            'name' => 'create ovas',
            'description' => 'Crear ovas'
        ]);
        Permission::create([
            'name' => 'update ovas',
            'description' => 'Actualizar ovas'
        ]);
        Permission::create([
            'name' => 'delete ovas',
            'description' => 'Eliminar ovas'
        ]);
        Permission::create([
            'name' => 'create manuals',
            'description' => 'Crear manuales'
        ]);
        Permission::create([
            'name' => 'update manuals',
            'description' => 'Actualizar manuales'
        ]);
        Permission::create([
            'name' => 'delete manuals',
            'description' => 'Eliminar manuales'
        ]);
        Permission::create([
            'name' => 'create presentations',
            'description' => 'Crear entregables'
        ]);
        Permission::create([
            'name' => 'update presentations',
            'description' => 'Actualizar entregables'
        ]);
        Permission::create([
            'name' => 'delete presentations',
            'description' => 'Eliminar entregables'
        ]);
    }
}
