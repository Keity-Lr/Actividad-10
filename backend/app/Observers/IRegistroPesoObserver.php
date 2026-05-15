<?php

namespace App\Observers;

interface IRegistroPesoObserver
{
    public function actualizar(array $datos): void;
}
