<?php

namespace App\Services;

use App\Contracts\IEstimadorPesoClient;
use App\Models\Animal;
use App\Models\Pesaje;

class EstimadorPesoService 
{
    private $client;

    // Inyectamos la abstracción, no la clase concreta (DIP)
    public function __construct(IEstimadorPesoClient $client) 
    {
        $this->client = $client;
    }

    public function estimar(int $animalId, array $urlsFotos): Pesaje
    {
        $animal = Animal::findOrFail($animalId);

        // Llamamos a la abstracción
        $datos = $this->client->obtenerEstimacion(
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