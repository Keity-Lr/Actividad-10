<?php

namespace App\Contracts;

use App\Models\Animal;

interface IAnimalReader {
    public function buscarPorArete(string $arete): ?Animal;
    public function listarPorRancho(int $fincaId): array;
    public function obtenerHistorialPeso(int $animalId): array;
}