<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/tvshows', 'TvShowsController@index')->name('tvshows.index');
Route::get('/tvshows/{tvshow}', 'TvShowsController@show')->name('tvshows.show');

Route::get('/peoples', 'PeoplesController@index')->name('peoples.index');
Route::get('/peoples/page/{page?}', 'PeoplesController@index');
Route::get('/peoples/{people}', 'PeoplesController@show')->name('peoples.show');

