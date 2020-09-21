<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions\\

        # famers permission.
        Permission::create(['name' => "farmer_permisions"]); 
        # customer permission.
        Permission::create(['name' => 'customer_permissions']);
        # supplier permission.
        Permission::create(['name' => 'supplier_permissions']);
        # vet permission.
        Permission::create(['name' => 'vet_permissions']);
        # FEo permission.
        Permission::create(['name' => 'feo_permissions']);
        # Admin permission.
        Permission::create(['name' => 'admin']);




        // create roles and assign created permissions

        // this can be done as separate statements
        #grant admin
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('admin');
        #farmer
        $role = Role::create(['name' => 'farmer']);
        $role->givePermissionTo(['farmer_permisions']);
        #vet
        $role = Role::create(['name' => 'vet']);
        $role->givePermissionTo(['vet_permissions']);
        #feo
        $role = Role::create(['name' => 'feo']);
        $role->givePermissionTo(['feo_permissions']);
        #supplier
        $role = Role::create(['name' => 'supplier']); 
        $role->givePermissionTo(['supplier_permissions']);
        #customer
        $role = Role::create(['name' => 'customer']);
        $role->givePermissionTo(['customer_permissions']);
;



    }
}
