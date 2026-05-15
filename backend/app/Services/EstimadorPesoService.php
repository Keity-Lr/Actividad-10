<?php

namespace App\Services;

use App\Contracts\IEstimadorPesoClient;
use App\Models\Animal;
use App\Models\Pesaje;

class EstimadorPesoService 
{
    private $algoritmo;

    // Inyectamos la abstracción, no la clase concreta (DIP)
    public function __construct(IAlgoritmoEstimacion $algoritmo) 
    {
        $this->algoritmo = $algoritmo;
    }

    public function estimar(int $animalId, array $urlsFotos): Pesaje
    {
        $animal = Animal::findOrFail($animalId);

       $datos = $this->algoritmo->ejecutar(
    $urlsFotos,
    $animal->raza->nombre,
    $animal->calcularEdadEnMeses()
);

        return Pesaje::create([
            'animal_id' => $animalId,
            'peso_kg'   => $datos['estimated_weight_kg'],
            'confianza_porcentaje' => $datos['confidence'] * 100,
            'metodo_estimacion' => 'yolov8',
            'fecha' => now(),
        ]);
    }
}
