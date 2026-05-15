<?php

namespace App\Contracts;

interface IEstimadorPesoClient 
{
    /**
     * @return array ['estimated_weight_kg' => float, 'confidence' => float]
     */
    public function obtenerEstimacion(array $urlsFotos, string $raza, int $edadMeses): array;
}