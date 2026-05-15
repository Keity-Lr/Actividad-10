<?php
namespace App\Services\Reportes;

use App\Contracts\IReporteStrategy;
use App\Models\Animal;

class ReporteInventario implements IReporteStrategy {
    public function generar(int $fincaId): array {
        return Animal::where('finca_id', $fincaId)
            ->select('nombre', 'numero_arete', 'raza_id', 'estado', 'ruta_pdf_registro')
            ->get()->toArray();
    }
}