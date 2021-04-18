<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Job Postings
    Route::apiResource('job-postings', 'JobPostingApiController');

    // Post Locations
    Route::apiResource('post-locations', 'PostLocationApiController');

    // Post Histories
    Route::apiResource('post-histories', 'PostHistoryApiController');

    // Clicks
    Route::apiResource('clicks', 'ClickApiController');

    // Credentials
    Route::apiResource('credentials', 'CredentialsApiController');

    // Drivers
    Route::apiResource('drivers', 'DriverApiController');
});
