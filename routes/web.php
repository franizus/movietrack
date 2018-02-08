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
    return view('index', compact('movies', 'type'));
})->name('home');

Route::get('/movies/{type}', function ($type) {
    $api = 'https://api.themoviedb.org/3/movie/' . $type . '?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES&page=1&region=us';
    $movieapi = json_decode(file_get_contents($api), true);
    $movies = $movieapi['results'];
    return view('movies', compact('movies', 'type'));
});

Route::get('/series/{type}', function ($type) {
    $api = 'https://api.themoviedb.org/3/tv/' . $type . '?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES&page=1';
    $tvapi = json_decode(file_get_contents($api), true);
    $series = $tvapi['results'];
    return view('series', compact('series', 'type'));
});

Route::get('/movie/{id}', function ($id) {
    $api = 'https://api.themoviedb.org/3/movie/' . $id . '?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES';
    $movie = json_decode(file_get_contents($api), true);
    $apiTrailer = 'https://api.themoviedb.org/3/movie/' . $id . '/videos?api_key=d86068144f769b45826958d1251e8f6d&language=en-US';
    $trailer = json_decode(file_get_contents($apiTrailer), true);
    $apiSimilar = 'https://api.themoviedb.org/3/movie/' . $id . '/similar?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES';
    $similar = json_decode(file_get_contents($apiSimilar), true);
    if (isset($similar['results'])) {
        $similar = $similar['results'];
    } else {
        $similar = false;
    }
    return view('movie', compact('movie', 'trailer', 'similar'));
});

Route::get('/serie/{id}', function ($id) {
    $api = 'https://api.themoviedb.org/3/tv/' . $id . '?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES';
    $serie = json_decode(file_get_contents($api), true);
    $apiTrailer = 'https://api.themoviedb.org/3/tv/' . $id . '/videos?api_key=d86068144f769b45826958d1251e8f6d&language=en-US';
    $trailer = json_decode(file_get_contents($apiTrailer), true);
    $apiSimilar = 'https://api.themoviedb.org/3/tv/' . $id . '/similar?api_key=d86068144f769b45826958d1251e8f6d&language=es-ES';
    $similar = json_decode(file_get_contents($apiSimilar), true);
    if (isset($similar['results'])) {
        $similar = $similar['results'];
    } else {
        $similar = false;
    }
    return view('serie', compact('serie', 'trailer', 'similar'));
});

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');
