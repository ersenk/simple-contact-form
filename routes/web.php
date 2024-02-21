<?php


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
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

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');

    // Email Template
    Route::delete('email-templates/destroy', 'EmailTemplateController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplateController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplateController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplateController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/media', 'CountriesController@storeMedia')->name('countries.storeMedia');
    Route::post('countries/ckmedia', 'CountriesController@storeCKEditorImages')->name('countries.storeCKEditorImages');
    Route::resource('countries', 'CountriesController');

    // Send Email
    Route::delete('send-emails/destroy', 'SendEmailController@massDestroy')->name('send-emails.massDestroy');
    Route::resource('send-emails', 'SendEmailController');

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
Route::get('/', 'HomeController@index');
Route::post('/contactform-storepublic', 'Frontend\ContactController@storepublic')->name('frontend.contacts.storepublic');

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');

    // Email Template
    Route::delete('email-templates/destroy', 'EmailTemplateController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplateController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplateController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplateController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/media', 'CountriesController@storeMedia')->name('countries.storeMedia');
    Route::post('countries/ckmedia', 'CountriesController@storeCKEditorImages')->name('countries.storeCKEditorImages');
    Route::resource('countries', 'CountriesController');

    // Send Email
    Route::delete('send-emails/destroy', 'SendEmailController@massDestroy')->name('send-emails.massDestroy');
    Route::resource('send-emails', 'SendEmailController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
