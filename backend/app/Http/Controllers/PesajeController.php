<?php

namespace App\Http\Controllers;

use App\Models\Pesaje;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PesajeController extends Controller
{
    public function listar(): JsonResponse
    {
        $pesajes = Pesaje::all();

        return response()->json([
            'exito' => true,
            'datos' => $pesajes
        ]);
    }

    public function obtenerPorAnimal(int $animal_id): JsonResponse
    {
        $pesajes = Pesaje::where('animal_id', $animal_id)->get();

        return response()->json([
            'exito' => true,
            'datos' => $pesajes
        ]);
    }

    public function crear(Request $request): JsonResponse
    {
        $datos = $this->validarDatos($request);

        $pesaje = Pesaje::create($datos);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Pesaje creado correctamente',
            'datos' => $pesaje
        ], 201);
    }

    public function obtener(int $id): JsonResponse
    {
        $pesaje = Pesaje::findOrFail($id);

        return response()->json([
            'exito' => true,
            'datos' => $pesaje
        ]);
    }

    public function actualizar(Request $request, int $id): JsonResponse
    {
        $pesaje = Pesaje::findOrFail($id);

        $datos = $this->validarDatos($request);

        $pesaje->update($datos);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Pesaje actualizado correctamente',
            'datos' => $pesaje
        ]);
    }

    public function eliminar(int $id): JsonResponse
    {
        $pesaje = Pesaje::findOrFail($id);
        $pesaje->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Pesaje eliminado correctamente'
        ]);
    }

    private function validarDatos(Request $request): array
    {
        return $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'peso_estimado' => 'required|numeric|min:0',
            'peso_real' => 'nullable|numeric|min:0',
            'fecha' => 'required|date',
            'fuente' => 'nullable|string|max:255'
        ]);
    }
}