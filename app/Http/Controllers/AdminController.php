<?php

namespace App\Http\Controllers;

use App\Models\Movie;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $movies = false;

        $getCookie = \Cookie::get('aglet_movie_database');

        if($getCookie){
            $cookieData = explode('::', $getCookie);
            $movies = Movie::whereIn('movie_id', $cookieData)->paginate(9);
        }
        
        return view('admin.dashboard', ['movies' => $movies]);
    }

}
