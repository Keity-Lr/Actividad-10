<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finca; //

class FincaController extends Controller
{
    public function listarFincas()
    {
        return Finca::all();
    }

    public function crearFinca(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'ubicacion' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $finca = Finca::create($request->all());

        return response()->json($finca, 201);
    }

    public function obtenerFinca($id)
    {
        $finca = Finca::find($id);

        if (!$finca) {
            return response()->json([
                'message' => 'Finca no encontrada'
            ], 404);
        }

        return response()->json($finca, 200);
    }

    public function actualizarFinca(Request $request, $id)
    {
        $finca = Finca::find($id);

        if (!$finca) {
            return response()->json(['message' => 'No existe'], 404);
        }

        $finca->update($request->all());

        return response()->json($finca, 200);
    }

    public function eliminarFinca($id)
    {
        $finca = Finca::find($id);

        if (!$finca) {
            return response()->json(['message' => 'No existe'], 404);
        }

        $finca->delete();

        return response()->json(['message' => 'Eliminada'], 200);
    }

    public function obtenerFincasPorUsuario($user_id)
    {
        return Finca::where('user_id', $user_id)->get();
    }
}