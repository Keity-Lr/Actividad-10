<?php

namespace App\Strategies;

interface IAlgoritmoEstimacion
{
    public function ejecutar(array $urlsFotos, string $raza, int $edadMeses): array;
}
