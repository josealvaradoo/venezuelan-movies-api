<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
            "data" => User::all(),
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
            "data" => User::find($id),
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

        $user = User::create([
            "name" => $data["name"],
            "email" => strtolower($data["email"]),
            "password" => Hash::make($data["password"]),
            "ip_address" => $request->ipAddress()
        ]);

        return response()->json([
            "data" => $user,
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

        $user = User::find($id);

        if(!$user) {
            return response()->json([
                "data" => null,
                "message" => "This movie doesn´t exist",
                "code" => 404
            ], 404);
        }

        $user->update([
            "title" => $data["title"] ?? $user->title,
            "cover" => $data["cover"] ?? $user->cover
        ]);

        return response()->json([
            "data" => $user,
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
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                "data" => null,
                "message" => "This movie doesn´t exist",
                "code" => 404
            ], 404);
        }

        $user->delete();

        return response()->json([
            "data" => null,
            "message" => "Movie removed successfully!",
            "code" => 200
        ], 200);
    }
}
