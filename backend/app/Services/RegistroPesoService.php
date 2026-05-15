<?php

namespace App\Services;

use App\Observers\RegistroPesoSubject;
use App\Observers\NotificadorPropietario;
use App\Observers\RecalculadorICC;
use App\Observers\WebhookSenasa;
use App\Observers\AlertaSMS;

class RegistroPesoService
{
    public function registrarPeso(array $datos)
    {
        $subject = new RegistroPesoSubject();

        $subject->suscribir(new NotificadorPropietario());
        $subject->suscribir(new RecalculadorICC());
        $subject->suscribir(new WebhookSenasa());
        $subject->suscribir(new AlertaSMS());

        $subject->notificar($datos);
    }
}
