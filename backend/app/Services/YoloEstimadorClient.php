<?php

namespace App\Services;

use App\Contracts\IEstimadorPesoClient;
use Illuminate\Support\Facades\Http;

class YoloEstimadorClient implements IEstimadorPesoClient 
{
    private string $url = 'http://localhost:5000/estimate';

    public function obtenerEstimacion(array $urlsFotos, string $raza, int $edadMeses): array 
    {
        $respuesta = Http::timeout(30)->post($this->url, [
            'image_urls' => $urlsFotos,
            'breed'      => $raza,
            'age_months' => $edadMeses,
        ]);

        if (!$respuesta->successful()) {
            throw new \RuntimeException('Servicio ML no disponible.');
        }

        return $respuesta->json();
    }
}