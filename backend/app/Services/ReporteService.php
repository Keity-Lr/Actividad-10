<?php

namespace App\Services;

use App\Contracts\IReporteStrategy;

class ReporteService 
{
    /**
     * Este método está CERRADO para modificación.
     * No importa cuántos reportes nuevos existan en el futuro, 
     * este código NO cambiará. Solo recibe una nueva estrategia.
     */
    public function generar(IReporteStrategy $estrategia, int $fincaId): array 
    {
        return $estrategia->generar($fincaId);
    }
}