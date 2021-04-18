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
                'title' => 'job_posting_create',
            ],
            [
                'id'    => 23,
                'title' => 'job_posting_edit',
            ],
            [
                'id'    => 24,
                'title' => 'job_posting_show',
            ],
            [
                'id'    => 25,
                'title' => 'job_posting_delete',
            ],
            [
                'id'    => 26,
                'title' => 'job_posting_access',
            ],
            [
                'id'    => 27,
                'title' => 'post_location_create',
            ],
            [
                'id'    => 28,
                'title' => 'post_location_edit',
            ],
            [
                'id'    => 29,
                'title' => 'post_location_show',
            ],
            [
                'id'    => 30,
                'title' => 'post_location_delete',
            ],
            [
                'id'    => 31,
                'title' => 'post_location_access',
            ],
            [
                'id'    => 32,
                'title' => 'post_history_create',
            ],
            [
                'id'    => 33,
                'title' => 'post_history_edit',
            ],
            [
                'id'    => 34,
                'title' => 'post_history_show',
            ],
            [
                'id'    => 35,
                'title' => 'post_history_delete',
            ],
            [
                'id'    => 36,
                'title' => 'post_history_access',
            ],
            [
                'id'    => 37,
                'title' => 'click_create',
            ],
            [
                'id'    => 38,
                'title' => 'click_edit',
            ],
            [
                'id'    => 39,
                'title' => 'click_show',
            ],
            [
                'id'    => 40,
                'title' => 'click_delete',
            ],
            [
                'id'    => 41,
                'title' => 'click_access',
            ],
            [
                'id'    => 42,
                'title' => 'credential_create',
            ],
            [
                'id'    => 43,
                'title' => 'credential_edit',
            ],
            [
                'id'    => 44,
                'title' => 'credential_show',
            ],
            [
                'id'    => 45,
                'title' => 'credential_delete',
            ],
            [
                'id'    => 46,
                'title' => 'credential_access',
            ],
            [
                'id'    => 47,
                'title' => 'driver_create',
            ],
            [
                'id'    => 48,
                'title' => 'driver_edit',
            ],
            [
                'id'    => 49,
                'title' => 'driver_show',
            ],
            [
                'id'    => 50,
                'title' => 'driver_delete',
            ],
            [
                'id'    => 51,
                'title' => 'driver_access',
            ],
            [
                'id'    => 52,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
