<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImagenController extends Controller
{
    public function listar(): JsonResponse
    {
        $imagenes = Imagen::all();

        return response()->json([
            'exito' => true,
            'datos' => $imagenes
        ]);
    }

    public function obtenerPorAnimal(int $animal_id): JsonResponse
    {
        $imagenes = Imagen::where('animal_id', $animal_id)->get();

        return response()->json([
            'exito' => true,
            'datos' => $imagenes
        ]);
    }

    public function crear(Request $request): JsonResponse
    {
        $datos = $this->validarDatos($request);

        $imagen = Imagen::create($datos);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Imagen creada correctamente',
            'datos' => $imagen
        ], 201);
    }//No estoy segura si es el metodo correcto, ya que no se si la imagen se va a subir
    //  al servidor o se va a guardar solo la url, si se va a subir la imagen, entonces se
    //  tendria que usar el metodo store() para guardar la imagen en el servidor y luego guardar
    //  la url en la base de datos y si se va a guardar solo la url, entonces el metodo crear() estaria correcto

    public function obtener(int $id): JsonResponse
    {
        $imagen = Imagen::findOrFail($id);

        return response()->json([
            'exito' => true,
            'datos' => $imagen
        ]);
    }

    public function actualizar(Request $request, int $id): JsonResponse
    {
        $imagen = Imagen::findOrFail($id);

        $datos = $this->validarDatos($request);

        $imagen->update($datos);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Imagen actualizada correctamente',
            'datos' => $imagen
        ]);
    }

    public function eliminar(int $id): JsonResponse
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Imagen eliminada correctamente'
        ]);
    }

    private function validarDatos(Request $request): array
    {
        return $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'url' => 'required|string|url',
            'procesada' => 'nullable|boolean',
            'fecha' => 'required|date'
        ]);
    }
}
