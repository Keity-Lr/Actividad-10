<?php

namespace App\Contracts;

use App\Models\Animal;

interface IAnimalWriter {
    public function crear(array $datos): Animal;
    public function actualizar(int $id, array $datos): Animal;
    public function eliminar(int $id): void;
}