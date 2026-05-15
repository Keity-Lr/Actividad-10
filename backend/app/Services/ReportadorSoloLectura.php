<?php

namespace App\Services;

use App\Contracts\IAnimalReader;
use App\Models\Animal;

/**
 * Al implementar SOLO IAnimalReader, esta clase ya no está obligada
 * a tener métodos de escritura (crear, eliminar) vacíos.
 */
class ReportadorSoloLectura implements IAnimalReader 
{
    public function buscarPorArete(string $arete): ?Animal 
    {
        return Animal::where('numero_arete', $arete)->first();
    }

    public function listarPorRancho(int $fincaId): array 
    {
        return Animal::where('finca_id', $fincaId)->get()->toArray();
    }

    public function obtenerHistorialPeso(int $animalId): array 
    {
        // Supongamos que Animal tiene una relación con Pesajes
        $animal = Animal::with('pesajes')->find($animalId);
        return $animal ? $animal->pesajes->toArray() : [];
    }
}