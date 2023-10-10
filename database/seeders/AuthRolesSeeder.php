<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use \App\Models\User;


class AuthRolesSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'super-admin-access']);
        Permission::create(['name' => 'admin-can-access']);
        Permission::create(['name' => 'authenticated-user-can-access']);

        Permission::create(['name' => 'admin-can-authenticate-member']);
        Permission::create(['name' => 'admin-can-unauthenticate-user']);
        Permission::create(['name' => 'admin-can-edit-user']);
        Permission::create(['name' => 'admin-can-view-users']);
        Permission::create(['name' => 'admin-can-delete-user']);
        Permission::create(['name' => 'admin-can-delete-non-owned-blog']);

        Permission::create(['name' => 'can-edit-owned-blog']);
        Permission::create(['name' => 'can-write-blog']);
        Permission::create(['name' => 'can-delete-self-blog']);
        Permission::create(['name' => 'can-publish-blog']);
        Permission::create(['name' => 'can-unpublish-blog']);

        Permission::create(['name' => 'can-edit-own-comment']);
        Permission::create(['name' => 'can-write-comment']);
        Permission::create(['name' => 'can-delete-own-comment']);
        Permission::create(['name' => 'can-publish-comment']);
        Permission::create(['name' => 'admin-can-delete-non-owned-comment']);

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $authenticatedUser = Role::create(['name' => 'authenticated-user']);


        $superAdminRole->givePermissionTo([
             'super-admin-access',
         ]);

        $adminRole->givePermissionTo([
            'admin-can-access',
            'admin-can-authenticate-member',
            'admin-can-edit-user',
            'admin-can-view-users',
            'admin-can-delete-user',
            'admin-can-unauthenticate-user',
            'can-publish-blog',
            'can-unpublish-blog',
            'admin-can-delete-non-owned-blog',
            'admin-can-delete-non-owned-comment'
        ]);

        $authenticatedUser->givePermissionTo([
            'authenticated-user-can-access',
            'can-write-blog',
            'can-edit-owned-blog',
            'can-write-blog',
            'can-delete-self-blog',
            'can-write-comment',
            'can-edit-own-comment',
            'can-delete-own-comment',
        ]);

        $user = User::factory()->create([
            'name' => 'Super Admin User',
            'password' => bcrypt('password'),
            'email' => 'superadmin@yahoo.com',
        ]);
        $user->assignRole($superAdminRole);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'password' => bcrypt('password'),
            'email' => 'admin@yahoo.com',
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Test Member',
            'password' => bcrypt('password'),
            'email' => 'testmember@yahoo.com',
        ]);
        $user->assignRole($authenticatedUser);

        $user = User::factory()->create([
            'name' => 'Test Member',
            'password' => bcrypt('password'),
            'email' => 'testmembertwo@yahoo.com',
        ]);
        $user->assignRole($authenticatedUser);
    }
}
