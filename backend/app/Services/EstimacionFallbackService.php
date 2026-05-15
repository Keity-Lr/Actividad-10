<?php

namespace App\Services;

use App\Strategies\AlgoritmoTablaReferencia;
use App\Strategies\AlgoritmoYolov8;

class EstimacionFallbackService
{
    public function estimar(array $urlsFotos, string $raza, int $edadMeses): array
    {
        try {

            $algoritmo = app(AlgoritmoYolov8::class);

            return $algoritmo->ejecutar(
                $urlsFotos,
                $raza,
                $edadMeses
            );

        } catch (\Exception $e) {

            $fallback = new AlgoritmoTablaReferencia();

            return $fallback->ejecutar(
                $urlsFotos,
                $raza,
                $edadMeses
            );
        }
    }
}
