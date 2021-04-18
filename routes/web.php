<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Job Postings
    Route::delete('job-postings/destroy', 'JobPostingController@massDestroy')->name('job-postings.massDestroy');
    Route::resource('job-postings', 'JobPostingController');

    // Post Locations
    Route::delete('post-locations/destroy', 'PostLocationController@massDestroy')->name('post-locations.massDestroy');
    Route::post('post-locations/parse-csv-import', 'PostLocationController@parseCsvImport')->name('post-locations.parseCsvImport');
    Route::post('post-locations/process-csv-import', 'PostLocationController@processCsvImport')->name('post-locations.processCsvImport');
    Route::resource('post-locations', 'PostLocationController');

    // Post Histories
    Route::delete('post-histories/destroy', 'PostHistoryController@massDestroy')->name('post-histories.massDestroy');
    Route::resource('post-histories', 'PostHistoryController');

    // Clicks
    Route::delete('clicks/destroy', 'ClickController@massDestroy')->name('clicks.massDestroy');
    Route::resource('clicks', 'ClickController');

    // Credentials
    Route::delete('credentials/destroy', 'CredentialsController@massDestroy')->name('credentials.massDestroy');
    Route::resource('credentials', 'CredentialsController');

    // Drivers
    Route::delete('drivers/destroy', 'DriverController@massDestroy')->name('drivers.massDestroy');
    Route::resource('drivers', 'DriverController');

    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::group(['prefix' => 'shorten', 'as' => 'shorten.', 'namespace' => 'Shorten', 'middleware' => ['auth']], function(){
    Route::resource('bubsRD61be6ljFLy', 'ShortenUrlController');
    //Route::Resource('bubsRD61be6ljFLy', 'ShortenUrlController');
    //Route::resource('drivers', 'DriverController');
});
