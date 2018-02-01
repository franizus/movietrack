<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $movieapi = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES&page=1'), true);
    $movies = $movieapi['results'];
    return view('index', compact('movies'));
})->name('home');

Route::get('/series', function () {
    $tvapi = json_decode(file_get_contents('https://api.themoviedb.org/3/tv/popular?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES&page=1'), true);
    $series = $tvapi['results'];
    return view('series', compact('series'));
});

Route::get('/register', function () {
    $movieapi = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES&page=1'), true);
    $movies = $movieapi['results'];
    return view('index', compact('movies'));
});

Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');
