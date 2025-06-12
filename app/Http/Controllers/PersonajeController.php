<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Personaje::query();

        // Filtro por rol (ej: /personajes/rol=protagonista)
        if ($request->has('rol')) {
            $query->where('rol', 'LIKE', '%' . $request->rol . '%');
        }

        // Búsqueda por nombre (ej: /personajes?nombre=Naruto)
        if ($request->has('nombre')) {
            $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
        }

        $personajes = $query->with("anime")->get();
        return response()->json([
            "status"=>"success",
            "datos"=> $personajes
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $personaje = Personaje::create($request->all());
        $personaje = new Personaje();
        $personaje->nombre= $request->nombre;
        $personaje->rol = $request->rol;
        $personaje->descripcion= $request->descripcion;
        $personaje->anime_id= $request->anime_id;
        $personaje->save();

        return response()->json([
            "status"=>"success",
            "message"=> "Se agregó correctamente",
            "datos"=> $personaje
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Personaje $personaje)
    {
        return response()->json([
            "status"=>"success",
            "datos"=> $personaje->load("anime")
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personaje $personaje)
    {
        $personaje->update($request->all());

        return response()->json([
            "status"=>"success",
            "message"=> "Se modificó correctamente",
            "datos"=> $personaje
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personaje $personaje)
    {
        $personaje->delete();

        return response()->json([
            "status"=>"success",
            "message"=> "Se eliminó correctamente",
            "datos"=> $personaje
        ],200);
    }
}
