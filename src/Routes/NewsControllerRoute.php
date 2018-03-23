<?php

Route::group(['prefix' => 'console', 'middleware' => ['web']], function () {

    Route::resource('/news', 'OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController');

});
