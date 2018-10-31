<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        Permission::create(['name' => 'all']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'merchant']);
        Role::create(['name' => 'customer']);

        $user = User::find(1);
        $user->assignRole('admin');
    }
}