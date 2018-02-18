<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id)
    {
        $movies = DB::table('movies')->where('user_id', $id)->get();
        $series = DB::table('series')->where('user_id', $id)->get();
        return view('user.show', compact('movies', 'series'));
    }
}
