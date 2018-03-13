<?php

Route::get('/', [
    'uses' => 'PostController@index',
    'as' => 'blog.index'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@post',
    'as' => 'blog.post'
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('', [
        'uses' => 'PostController@adminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminUpdate',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});
Auth::routes();
