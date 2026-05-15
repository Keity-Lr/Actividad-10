<?php

namespace App\Repositories;

use App\Models\Animal;

interface IAnimalRepository
{
    public function findAll(): array;

    public function findById(int $id): ?Animal;

    public function save(array $datos): Animal;
}
