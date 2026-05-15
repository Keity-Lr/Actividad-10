<?php

namespace App\Observers;

class RegistroPesoSubject
{
    private array $observers = [];

    public function suscribir(IRegistroPesoObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    public function notificar(array $datos): void
    {
        foreach ($this->observers as $observer) {
            $observer->actualizar($datos);
        }
    }
}
