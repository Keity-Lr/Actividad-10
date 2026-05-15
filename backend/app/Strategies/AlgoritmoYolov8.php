<?php

namespace App\Strategies;

use App\Contracts\IEstimadorPesoClient;

class AlgoritmoYolov8 implements IAlgoritmoEstimacion
{
    private $client;

    public function __construct(IEstimadorPesoClient $client)
    {
        $this->client = $client;
    }

    public function ejecutar(array $urlsFotos, string $raza, int $edadMeses): array
    {
        return $this->client->obtenerEstimacion(
            $urlsFotos,
            $raza,
            $edadMeses
        );
    }
}
