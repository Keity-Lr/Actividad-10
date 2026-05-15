<?php

namespace App\Observers;

class AlertaSMS implements IRegistroPesoObserver
{
    public function actualizar(array $datos): void
    {
        echo "SMS enviado";
    }
}
