<?php

namespace App\Strategies;

class AlgoritmoRegresionLineal implements IAlgoritmoEstimacion
{
    public function ejecutar(array $urlsFotos, string $raza, int $edadMeses): array
    {
        return [
            'estimated_weight_kg' => 420,
            'confidence' => 0.80
        ];
    }
}
