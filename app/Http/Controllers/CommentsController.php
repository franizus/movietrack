<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function storeMovie($id)
    {
        DB::table('comments')->insert(
            [
                'body' => request('body'), 
                'movie_id' => $id, 
                'serie_id' => -1, 
                'user_id' => auth()->id(), 
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );

        return back();
    }

    public function storeSerie($id)
    {
        DB::table('comments')->insert(
            [
                'body' => request('body'), 
                'serie_id' => $id, 
                'movie_id' => -1, 
                'user_id' => auth()->id(), 
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );

        return back();
    }
}
