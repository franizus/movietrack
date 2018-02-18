<?php

use App\Http\Controllers;

Route::get('/', function () {
    $movies = Controllers\MoviesController::getMovies('popular', 1);
    $series = Controllers\SeriesController::getSeries('popular', 1);
    return view('index', compact('movies', 'series'));
})->name('home');

Route::get('/search/', 'SearchController@show');

Route::get('/movies/{type}/{page}', 'MoviesController@index');
Route::get('/movie/{id}', 'MoviesController@show');
Route::post('/movie/{id}/comments', 'CommentsController@storeMovie');
Route::post('/movie/{id}/follow', 'MoviesController@store');
Route::post('/movie/{id}/unfollow', 'MoviesController@destroy');

Route::get('/series/{type}/{page}', 'SeriesController@index');
Route::get('/serie/{id}', 'SeriesController@show');
Route::post('/serie/{id}/comments', 'CommentsController@storeSerie');
Route::post('/serie/{id}/follow', 'SeriesController@store');
Route::post('/serie/{id}/unfollow', 'SeriesController@destroy');
Route::get('/serie/{id}/{season}', 'SeriesController@showSeason');

Route::post('/user/{id}', 'UserController@update');
Route::get('/user/{id}', 'UserController@show');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');
