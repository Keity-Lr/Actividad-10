<?php

namespace App\Factories;

use App\Models\Raza;

class RazaFactory implements IRazaFactory
{
    public function create(string $nombreRaza): Raza
    {
        return Raza::where('nombre', $nombreRaza)->first();
    }
}
