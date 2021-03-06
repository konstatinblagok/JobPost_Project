<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'team'           => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
        ],
    ],
    'jobPosting'     => [
        'title'          => 'Job Posting',
        'title_singular' => 'Job Posting',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'title',
            'title_helper'          => ' ',
            'content'               => 'Content',
            'content_helper'        => ' ',
            'url'                   => 'Url',
            'url_helper'            => 'The URL to which you want to redirect to post',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'team'                  => 'Team',
            'team_helper'           => ' ',
            'post_locations'        => 'Post Locations',
            'post_locations_helper' => ' ',
        ],
    ],
    'postLocation'   => [
        'title'          => 'Post Location',
        'title_singular' => 'Post Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'driver'            => 'Driver',
            'driver_helper'     => ' ',
        ],
    ],
    'postHistory'    => [
        'title'          => 'Instance History',
        'title_singular' => 'Instance History',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'job_post'             => 'Job Post',
            'job_post_helper'      => ' ',
            'post_location'        => 'Post Location',
            'post_location_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'team'                 => 'Team',
            'team_helper'          => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'url'                  => 'Url',
            'url_helper'           => ' ',
        ],
    ],
    'click'          => [
        'title'          => 'Click',
        'title_singular' => 'Click',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'instance'          => 'Instance',
            'instance_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'credential'     => [
        'title'          => 'Credentials',
        'title_singular' => 'Credential',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'password'          => 'Password',
            'password_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'driver'            => 'Driver',
            'driver_helper'     => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'driver'         => [
        'title'          => 'Driver',
        'title_singular' => 'Driver',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
