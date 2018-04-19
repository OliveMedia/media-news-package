<?php

Route::group(['prefix' => 'console', 'middleware' => ['web', 'auth']], function () {

    Route::resource('/news', 'OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController');

});

Route::get('newsfacade', function () {
    return OliveMediaNews::getAllNews();
});
