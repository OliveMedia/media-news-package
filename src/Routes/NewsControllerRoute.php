<?php

Route::group(['prefix' => 'console', 'middleware' => ['web', 'auth']], function () {

    Route::resource('/news', 'OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController');

});
