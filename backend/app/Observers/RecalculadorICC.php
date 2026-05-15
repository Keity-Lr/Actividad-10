<?php

namespace App\Observers;

class RecalculadorICC implements IRegistroPesoObserver
{
    public function actualizar(array $datos): void
    {
        echo "ICC recalculado";
    }
}
