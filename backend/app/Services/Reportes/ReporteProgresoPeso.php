<?php

namespace App\Services\Reportes;

use App\Contracts\IReporteStrategy;
use App\Models\Animal;

class ReporteProgresoPeso implements IReporteStrategy {
    public function generar(int $fincaId): array {
        // Trae animales con sus registros de peso para calcular progreso
        return Animal::where('finca_id', $fincaId)
            ->with('registrosPeso') 
            ->get()
            ->map(function ($animal) {
                return [
                    'nombre' => $animal->nombre,
                    'progreso' => 'Cálculo de ganancia diaria...' // Simulación de lógica
                ];
            })->toArray();
    }
}