<?php

namespace App\Observers;

class NotificadorPropietario implements IRegistroPesoObserver
{
    public function actualizar(array $datos): void
    {
        echo "Correo enviado al propietario";
    }
}
