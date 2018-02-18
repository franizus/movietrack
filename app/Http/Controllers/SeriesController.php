<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SeriesController extends Controller
{

    public static function getSeries($type, $page)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/tv/' . $type, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES',
                'page' => $page
            ]
        ]);
        return json_decode($result->getBody(), true)['results'];
    }

    public static function getSerie($id)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/tv/' . $id, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES'
            ]
        ]);
        return json_decode($result->getBody(), true);
    }

    private function getSerieContent($id, $type, $lang)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/tv/' . $id . '/' . $type, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => $lang
            ]
        ]);
        return json_decode($result->getBody(), true);
    }

    public function index($type, $page)
    {
        $series = $this->getSeries($type, $page);
        $series1 = $this->getSeries($type, $page + 1);
        $series = array_merge($series, $series1);
        return view('series.index', compact('series', 'type', 'page'));
    }

    public function show($id)
    {
        $serie = $this->getSerie($id);
        $trailer = $this->getSerieContent($id, 'videos', 'en-US');
        $similar = $this->getSerieContent($id, 'similar', 'es-ES');
        if (isset($similar['results'])) {
            $similar = $similar['results'];
        } else {
            $similar = false;
        }
        $comments = DB::table('comments')->where('serie_id', $id)->get();
        return view('series.show', compact('serie', 'trailer', 'similar', 'id', 'comments'));
    }

    private function getName($id)
    {
        $serie = $this->getSerie($id);
        return $serie['name'];
    }

    public function showSeason($id, $season)
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/tv/' . $id . '/season/' . $season, [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES'
            ]
        ]);
        $seasons = json_decode($result->getBody(), true);
        $name = $this->getName($id);
        return view('series.season', compact('seasons', 'id', 'season', 'name'));
    }

    public function store($id)
    {
        DB::table('series')->insert(
            [
                'user_id' => auth()->id(),
                'serie_id' => $id
            ]
        );

        return back();
    }

    public function destroy($id)
    {
        DB::table('series')->where([
            ['user_id', auth()->id()],
            ['serie_id', $id],
        ])->delete();

        return back();
    }
}
