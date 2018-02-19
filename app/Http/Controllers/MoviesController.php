<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MoviesController extends Controller
{

    public static function getMovies($type, $page)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/movie/' . $type, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES',
                'page' => $page,
                'region' => 'us'
            ]
        ]);
        return json_decode($result->getBody(), true)['results'];
    }

    public static function getMovie($id)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/movie/' . $id, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES'
            ]
        ]);
        return json_decode($result->getBody(), true);
    }

    private function getMovieContent($id, $type, $lang)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/movie/' . $id . '/' . $type, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => $lang
            ]
        ]);
        return json_decode($result->getBody(), true);
    }

    public function index($type, $page)
    {
        $movies = $this->getMovies($type, $page);
        $movies1 = $this->getMovies($type, $page + 1);
        $movies = array_merge($movies, $movies1); 
        return view('movies.index', compact('movies', 'type', 'page'));
    }

    public function show($id)
    {
        $movie = $this->getMovie($id);
        $trailer = $this->getMovieContent($id, 'videos', 'en-US');
        $similar = $this->getMovieContent($id, 'similar', 'es-ES');
        if (isset($similar['results']) && sizeof($similar['results']) > 0) {
            $similar = $similar['results'];
        } else {
            $similar = false;
        }
        if (isset($trailer['results']) && sizeof($trailer['results']) > 0) {
            $trailer = $trailer['results'];
        } else {
            $trailer = false;
        }
        $comments = DB::table('comments')->where('movie_id', $id)->get();
        return view('movies.show', compact('movie', 'trailer', 'similar', 'comments', 'id'));
    }

    public function store($id)
    {
        DB::table('movies')->insert(
            [
                'user_id' => auth()->id(),
                'movie_id' => $id
            ]
        );

        return back();
    }

    public function destroy($id)
    {
        DB::table('movies')->where([
            ['user_id', auth()->id()],
            ['movie_id', $id],
        ])->delete();

        return back();
    }
}
