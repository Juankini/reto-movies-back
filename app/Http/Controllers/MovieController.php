<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Movie;
use App\Models\User;

class MovieController extends BaseController
{

    public function movie(Request $request)

    {
        $movie_id = $request->movie;
        $user_id = $request->user;
        $movie = Movie::find($movie_id);
        if($movie == null) {
            return $this->sendError('No ha sido creada la paelicula', ['error'=>'Unauthorised']);
        } else {
            $exists = $movie->users->contains($user_id);
            if ($exists !== null) {
                $success['favorite'] = true;
                return $this->sendResponse($success, 'Respuesta de favorito');
            } else {
                $success['favorite'] = false;
                return $this->sendResponse($success, 'Respuesta de favorito');
            }
            
            
        }
    }

    public function favorite(Request $request)

    {
        $movie_id = $request->movie_id;
        $user_id = $request->user_id;
        $favorite = $request->favorite;
        $movie = Movie::find($movie_id);
        if($movie == null) {
            $movie = $this->create($request);
        }

        if($favorite == true) {
            $movie->users()->attach($user_id);
            $success['favorite'] = true;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            $movie->users()->detach($user_id);
            $success['favorite'] = false;
            return $this->sendResponse($success, 'User login successfully.');
        }
    }

    public function create(Request $request)

    {
        $id = $request->movie_id;
        $title = $request->title;
        $description = $request->description;
        $genres = $request->genres;
        $released_at = $request->released_at;
        $vote_average = $request->vote_average;
        $vote_count = $request->vote_count;
        $poster_path = $request->poster_path;
        $spoken_languages = $request->spoken_languages;
        $cast = $request->cast;
        $movie = new Movie();

        $movie->id = $id;
        $movie->title = $title;
        $movie->description = $description;
        $movie->genres = $genres;
        $movie->released_at = $released_at;
        $movie->vote_average = $vote_average;
        $movie->vote_count = $vote_count;
        $movie->poster_path = $poster_path;
        $movie->spoken_languages = $spoken_languages;
        $movie->cast = $cast;
        $movie->save();
        $new_movie = Movie::find($id);
        return $new_movie;
    }
}
