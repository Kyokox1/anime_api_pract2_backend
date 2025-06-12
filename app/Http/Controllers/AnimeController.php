<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anime::query();

        // Filtro por año (ej: /animes?año=2023)
        if ($request->has('año')) {
            $query->where('año', $request->año);
        }

        // Filtro por género (ej: /animes?genero=acción)
        if ($request->has('genero')) {
            $query->where('genero', 'LIKE', '%' . $request->genero . '%');
        }

        // Búsqueda por nombre (ej: /animes?nombre=Naruto)
        if ($request->has('nombre')) {
            $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
        }

        $animes = $query->with("personajes")->get();
        return response()->json([
            "status"=>"success",
            "datos"=> $animes
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $anime= new Anime();
        $anime->nombre=$request->nombre;
        $anime->sinopsis=$request->sinopsis;
        $anime->año=$request->año;
        $anime->genero=$request->genero;
        $anime->estado=$request->estado;
        $anime->save();

        return response()->json([
            "status"=> "success",
            "message"=> "Se agregó correctamente",
            "datos"=> $anime
            ],200);
    

    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
            return response()->json([
            "status"=> "success",
            "datos"=> $anime->load("personajes")
        ],200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime)
    {
        $anime->nombre=$request->nombre;
        $anime->sinopsis=$request->sinopsis;
        $anime->año=$request->año;
        $anime->genero=$request->genero;
        $anime->estado=$request->estado;
        $anime->update();

        return response()->json([
            "status"=> "success",
            "message"=> "Se modificado correctamente",
            "datos"=> $anime
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {
        $anime->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "Se eliminó correctamente",
            "datos"=> $anime
            ],200);
    }

    public function getAnimeWithPersonajes(Anime $anime){
        return response()->json([
            "status"=> "success",
            "anime"=> $anime->nombre,
            "personajes"=> $anime->personajes
            ],200);
    }
}
