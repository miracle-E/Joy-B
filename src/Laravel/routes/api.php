<?php

// Route::post('/register', 'Auth\AuthController@register');
// Route::post('/login', 'Auth\AuthController@login');
// Route::post('/logout', 'Auth\AuthController@logout');


// Route::get('/user', 'Auth\AuthController@user');




// Below mention routes are public, user can access those without any restriction.
Route::prefix('v1/')->group(function () {
    Route::post('/register', 'Auth\AuthController@register');
    Route::post('/login', 'Auth\AuthController@login');

    Route::get('/category/{category}/content/{id}', 'CategoryController@getContent');
    Route::get('/category/{category}/subject/{id}', 'CategoryController@getSubject');

    Route::get('/category/{category}/contents', 'CategoryController@getContent');
    Route::get('/category/{category}/subjects', 'CategoryController@getSubject');

    Route::get('/category/{id}', 'CategoryController@show');
    Route::get('/categories', 'CategoryController@index');

    Route::get('/sub_category/{id}', 'SubCategoryController@show');
    Route::get('/sub_categories', 'SubCategoryController@index');

    Route::get('/subject/{id}', 'SubjectController@show');
    Route::get('/subjects', 'SubjectController@index');

    Route::get('/content/{id}', 'ContentController@show');
    Route::get('/contents', 'ContentController@index');

    Route::get('/content_type/{id}', 'ContentTypeController@show');
    Route::get('/content_types', 'ContentTypeController@index');

    Route::get('/content_access/{id}', 'ContentAccessController@show');
    Route::get('/content_accesses', 'ContentAccessController@index');
    Route::get('/ratings', 'RatingController@index');

    Route::get('/media', 'MediaController@index');
    Route::get('/media/{id}', 'MediaController@show');

    Route::get('/tag', 'TagController@index');
    Route::get('/tags/{id}', 'TagController@show');
});



Route::group(['prefix' => 'v1/',  'middleware' => 'api'], function () {
    Route::post('/logout', 'Auth\AuthController@logout');
    Route::get('/user', 'Auth\AuthController@user');
    Route::post('/subject/subscribe', 'SubjectController@subscribe')->name('subject-subscribe');
});



Route::group(['prefix' => 'v1/admin/',  'middleware' => 'api'], function () {
    Route::resource('/categories', 'CategoryController');
    Route::resource('/sub_categories', 'SubCategoryController');
    Route::resource('/topics', 'TopicController');
    Route::post('/contents', 'ContentController@store');
    Route::resource('/contents', 'ContentController');
    Route::resource('/content_types', 'ContentTypeController');
    Route::resource('/content_access', 'ContentAccessController');
    Route::resource('/tags', 'TagController');
    Route::resource('/subjects', 'SubjectController');

    Route::resource('media', 'MediaController');
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Resource not found!'
    ], 404);
});
