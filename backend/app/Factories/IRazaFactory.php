<?php

namespace App\Factories;

use App\Models\Raza;

interface IRazaFactory
{
    public function create(string $nombreRaza): Raza;
}
