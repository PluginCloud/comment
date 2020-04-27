<?php

Route::group(['as' => 'content.'], function () {
    Route::get('/', "ContentController@index")->name("index");
    Route::get("info/{id}", "ContentController@info")->name("info");
    Route::get("search", "ContentController@search")->name("search");
    Route::get("contents", "ContentController@contents")->name("contents");
    Route::get("comments", "ContentController@comments")->name("comments");
    Route::group(['middleware' => ['logged:true']], function () {
        Route::get("publish", "ContentController@publish")->name("publish");
        Route::post("publishSubmit", "ContentController@publishSubmit")->name("publishSubmit");
        Route::get("edit/{id}", "ContentController@edit")->name("edit");
        Route::post("editSubmit", "ContentController@editSubmit")->name("editSubmit");
        Route::get("delete/{id}", "ContentController@delete")->name("delete");
    });
});
Route::group(['prefix' => 'user_ad', 'as' => 'user_ad.'], function () {
    Route::group(['middleware' => ['logged']], function () {
        Route::get("publish", "UserAdController@publish")->name("publish");
        Route::post("publishSubmit", "UserAdController@publishSubmit")->name("publishSubmit");
        Route::get("edit/{id}", "UserAdController@edit")->name("edit");
        Route::post("editSubmit", "UserAdController@editSubmit")->name("editSubmit");
        Route::get("delete/{id}", "UserAdController@delete")->name("delete");
    });
});
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get("home/{id}", "UserController@home")->name("home");
    Route::group(['middleware' => ['logged:false']], function () {
        Route::get('login', "UserController@login")->name("login");
        Route::post('loginSubmit', "UserController@loginSubmit")->name("loginSubmit");
        Route::get('register', "UserController@register")->name("register");
        Route::post('registerSubmit', "UserController@registerSubmit")->name("registerSubmit");
    });
    Route::group(['middleware' => ['logged']], function () {
        Route::get('logout', "UserController@logout")->name("logout");
        Route::get('center', "UserController@center")->name("center");
        Route::get('profile', "UserController@profile")->name("profile");
        Route::post('profileSubmit', "UserController@profileSubmit")->name("profileSubmit");
        Route::get('password', "UserController@password")->name("password");
        Route::post('passwordSubmit', "UserController@passwordSubmit")->name("passwordSubmit");
        Route::post('pictureUpload', "UserController@pictureUpload")->name("pictureUpload");
    });
});
