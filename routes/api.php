<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Contact
    Route::apiResource('contacts', 'ContactApiController');

    // Email Template
    Route::post('email-templates/media', 'EmailTemplateApiController@storeMedia')->name('email-templates.storeMedia');
    Route::apiResource('email-templates', 'EmailTemplateApiController');

    // Countries
    Route::post('countries/media', 'CountriesApiController@storeMedia')->name('countries.storeMedia');
    Route::apiResource('countries', 'CountriesApiController');

    // Send Email
    Route::apiResource('send-emails', 'SendEmailApiController');
});
