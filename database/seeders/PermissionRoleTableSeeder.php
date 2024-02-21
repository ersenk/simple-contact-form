<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();

        $auth_user_permissions = $admin_permissions->filter(function ($permission) {
            return  substr($permission->title, 0, 5) != 'user_' &&
                    substr($permission->title, 0, 5) != 'role_' &&
                    substr($permission->title, 0, 11)!= 'permission_' &&
                    substr($permission->title, 0, 5) != 'team_';
        });
        $not_auth_user_permissions = $admin_permissions->filter(function ($permission) {
            return  substr($permission->title, 0, 5) != 'user_' &&
                    substr($permission->title, 0, 5) != 'role_' &&
                    substr($permission->title, 0, 11)!= 'permission_' &&
                    substr($permission->title, 0, 5) != 'team_' &&
                    substr($permission->title, -7) != '_delete';
        });
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        Role::findOrFail(2)->permissions()->sync($auth_user_permissions);
        Role::findOrFail(3)->permissions()->sync($not_auth_user_permissions);
    }
}
