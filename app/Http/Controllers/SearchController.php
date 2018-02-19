<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function show()
    {
        $client = new Client();
        $result = $client->get('https://api.themoviedb.org/3/search/multi', [
            'form_params' => [
                'api_key' => 'd86068144f769b45826958d1251e8f6d',
                'language' => 'es-ES',
                'page' => 1,
                'query' => request('query'),
                'include_adult' => 'false'
            ]
        ]);
        $search = json_decode($result->getBody(), true);
        $results = $search['results'];
        $npage = $search['total_pages'];
        return view('search.show', compact('results', 'npage'));
    }
}
