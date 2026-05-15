<?php

namespace App\Strategies;

class AlgoritmoTablaReferencia implements IAlgoritmoEstimacion
{
    public function ejecutar(array $urlsFotos, string $raza, int $edadMeses): array
    {
        return [
            'estimated_weight_kg' => 400,
            'confidence' => 0.70
        ];
    }
}
