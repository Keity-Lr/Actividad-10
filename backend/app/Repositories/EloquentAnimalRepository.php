<?php

namespace App\Repositories;

use App\Models\Animal;

class EloquentAnimalRepository implements IAnimalRepository
{
    public function findAll(): array
    {
        return Animal::all()->all();
    }

    public function findById(int $id): ?Animal
    {
        return Animal::find($id);
    }

    public function save(array $datos): Animal
    {
        return Animal::create($datos);
    }
}
