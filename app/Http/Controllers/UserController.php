<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        $movies = DB::table('movies')->where('user_id', $id)->get();
        $series = DB::table('series')->where('user_id', $id)->get();
        return view('user.show', compact('movies', 'series'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        
        User::where('id', $id)->update([ 
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return back();
    }
}
