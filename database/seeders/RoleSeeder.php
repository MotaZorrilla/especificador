<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
		$role2 = Role::create(['name' => 'Cliente']);
        $role3 = Role::create(['name' => 'Ejecutivo']);

        Permission::create(['name'          => 'user',
                            'description'   => 'Ver el listado de Usuarios'])               ->syncRoles([$role1, $role3]);
        Permission::create(['name'          => 'profile',
                            'description'   => 'Ver su propio perfil '])                    ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name'          => 'filedata',
                            'description'   => 'Ver la base de datos de Pinturas'])         ->syncRoles([$role1, $role3]);
        Permission::create(['name'          => 'project',
                            'description'   => 'Ver el listado de tus proyectos'])          ->syncRoles([$role1, $role2, $role3]);        
        Permission::create(['name'          => 'projectAdmin',
                            'description'   => 'Ver el listado de todos los proyectos '])   ->syncRoles([$role1, $role3]);
        Permission::create(['name'          => 'plan',
                            'description'   => 'Ver el listado de planes'])                 ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name'          => 'role',
                            'description'   => 'Ver el listado de Roles'])                  ->syncRoles([$role1, $role3]);

    }
}
