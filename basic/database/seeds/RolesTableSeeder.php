<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'key' => 'A',
            'name' => 'Administrador',
            'description' => 'Administrador del sitio.'
        ]);

        Role::create([
            'key' => 'E',
            'name' => 'Estudiante',
            'description' => 'Rol para estudiantes.'
        ]);

        Role::create([
            'key' => 'M',
            'name' => 'Moderador',
            'description' => 'Rol para moderadores de contenido.'
        ]);
    }
}
