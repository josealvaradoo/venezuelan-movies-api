<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
    * Get all movies
    *
    */
    public function index()
    {
        return response()->json([
            "data" => Movie::all(),
            "message" => null,
            "code" => 200
        ], 200);
    }

    /*
    * Get only a movie by id
    *
    */
    public function get($id)
    {
        return response()->json([
            "data" => Movie::find($id),
            "message" => null,
            "code" => 200
        ], 200);
    }

    /*
    * Register a movie
    *
    */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        if(!$data) {
            return response()->json([
                "data" => [],
                "message" => "You mus't provide some movie data to save",
                "code" => 400
            ], 400);
        }

        $movie = Movie::create([
            "title" => $data["title"],
            "cover" => $data["cover"]
        ]);

        return response()->json([
            "data" => $movie,
            "message" => "Movie created successfully!",
            "code" => 201
        ], 201);
    }
    
    /*
    * Update a movie by id
    *
    */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();

        if(!$data) {
            return response()->json([
                "data" => [],
                "message" => "You mus't provide some movie data to save",
                "code" => 400
            ], 400);
        }

        $movie = Movie::find($id);

        if(!$movie) {
            return response()->json([
                "data" => null,
                "message" => "This movie doesn´t exist",
                "code" => 404
            ], 404);
        }

        $movie->update([
            "title" => $data["title"] ?? $movie->title,
            "cover" => $data["cover"] ?? $movie->cover
        ]);

        return response()->json([
            "data" => $movie,
            "message" => "Movie updated successfully!",
            "code" => 200
        ], 200);
    }

    /*
    * Delete a movie by id
    *
    */
    public function delete($id)
    {
        $movie = Movie::find($id);

        if(!$movie) {
            return response()->json([
                "data" => null,
                "message" => "This movie doesn´t exist",
                "code" => 404
            ], 404);
        }

        $movie->delete();

        return response()->json([
            "data" => null,
            "message" => "Movie removed successfully!",
            "code" => 200
        ], 200);
    }
}
