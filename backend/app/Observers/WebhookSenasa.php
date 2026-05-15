<?php

namespace App\Observers;

class WebhookSenasa implements IRegistroPesoObserver
{
    public function actualizar(array $datos): void
    {
        echo "Webhook enviado a SENASA";
    }
}
