<?php

namespace App\Services\Reportes;

use App\Contracts\IReporteStrategy;
use App\Models\Animal;

class ReporteCondicion implements IReporteStrategy {
    public function generar(int $fincaId): array {
        return Animal::where('finca_id', $fincaId)
            ->select('nombre', 'numero_arete', 'estado')
            ->get()->toArray();
    }
}