<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public static function addMovie($movie)
    {
        $movies = new self();

        $movies->title = $movie->title;
        $movies->poster = $movie->poster_path;
        $movies->release_date = $movie->release_date;
        $movies->movie_id = $movie->id;

        $movies->save();
    }
}
