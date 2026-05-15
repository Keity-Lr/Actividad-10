<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function crear(Request $request)
{
    $animal = Animal::create($request->all());

    return response()->json($animal, 201);
}

public function listar()
{
    $animales = Animal::all();
    return response()->json($animales);
}

public function buscarPorArete($arete)
{
    $animal = Animal::where('numero_arete', $arete)->first();

    if (!$animal) {
        return response()->json([
            'message' => 'Animal no encontrado'
        ], 404);
    }

    return response()->json($animal);
}

public function historial($id)
{
    $animal = Animal::with('pesajes')->findOrFail($id);
    return response()->json($animal);
}

public function obtener($id)
{
    $animal = Animal::findOrFail($id);
    return response()->json($animal);
}

public function actualizar(Request $request, $id)
{
    $animal = Animal::findOrFail($id);
    $animal->update($request->all());

    return response()->json($animal);
}

public function eliminar($id)
{
    $animal = Animal::findOrFail($id);
    $animal->estado = 'inactivo';
    $animal->save();

    return response()->json([
        'message' => 'Animal desactivado correctamente'
    ]);
}
}
