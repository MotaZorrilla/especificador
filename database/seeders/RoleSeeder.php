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

        Permission::create(['name' => 'users'])                ->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'filedata.index'])       ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.create'])      ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.edit'])        ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.destroy'])     ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.Import'])      ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.Export'])      ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.Order'])       ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.OrderList'])   ->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'filedata.Reset'])       ->syncRoles([$role1, $role3]);
        
        Permission::create(['name' => 'projectAdmin.index'])   ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'projectAdmin.create'])  ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'projectAdmin.edit'])    ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'projectAdmin.destroy']) ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'updateProjectAdmin'])   ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'projectAdmin.pdf'])     ->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'project.index'])         ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'project.create'])        ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'project.edit'])          ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'project.destroy'])       ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'updateProject'])         ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'project.pdf'])           ->syncRoles([$role1, $role2, $role3]);
        
        
    }
}
