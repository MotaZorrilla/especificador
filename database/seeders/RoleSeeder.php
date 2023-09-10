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
        $role1 = Role::create(['name' => 'Admin']);
		$role2 = Role::create(['name' => 'Client']);

        Permission::create(['name' => 'users'])                ->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'filedata.index'])       ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.create'])      ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.edit'])        ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.destroy'])     ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.Import'])      ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.Export'])      ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.Order'])       ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.OrderList'])   ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'filedata.Reset'])       ->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'projectAdmin.index'])   ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'projectAdmin.create'])  ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'projectAdmin.edit'])    ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'projectAdmin.destroy']) ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'updateProjectAdmin'])   ->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'projectAdmin.pdf'])     ->syncRoles([$role1, $role2]);
        
        
    }
}
