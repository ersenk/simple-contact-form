<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'contact_create',
            ],
            [
                'id'    => 23,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 24,
                'title' => 'contact_show',
            ],
            [
                'id'    => 25,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 26,
                'title' => 'contact_access',
            ],
            [
                'id'    => 27,
                'title' => 'email_template_create',
            ],
            [
                'id'    => 28,
                'title' => 'email_template_edit',
            ],
            [
                'id'    => 29,
                'title' => 'email_template_show',
            ],
            [
                'id'    => 30,
                'title' => 'email_template_delete',
            ],
            [
                'id'    => 31,
                'title' => 'email_template_access',
            ],
            [
                'id'    => 32,
                'title' => 'country_create',
            ],
            [
                'id'    => 33,
                'title' => 'country_edit',
            ],
            [
                'id'    => 34,
                'title' => 'country_show',
            ],
            [
                'id'    => 35,
                'title' => 'country_delete',
            ],
            [
                'id'    => 36,
                'title' => 'country_access',
            ],
            [
                'id'    => 37,
                'title' => 'email_access',
            ],
            [
                'id'    => 38,
                'title' => 'send_email_create',
            ],
            [
                'id'    => 39,
                'title' => 'send_email_edit',
            ],
            [
                'id'    => 40,
                'title' => 'send_email_show',
            ],
            [
                'id'    => 41,
                'title' => 'send_email_delete',
            ],
            [
                'id'    => 42,
                'title' => 'send_email_access',
            ],
            [
                'id'    => 43,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
