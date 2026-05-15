<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class AnimalPdfGenerator 
{
    public function generarRegistroPdf($animal, $propietario) 
    {
        $pdf = Pdf::loadView('reportes.registro_animal', [
            'animal' => $animal,
            'propietario' => $propietario,
            'fecha' => now()->format('d/m/Y H:i'),
        ]);

        $rutaPdf = 'registros/' . $animal->numero_arete . '_' . now()->timestamp . '.pdf';
        $pdf->save(storage_path('app/public/' . $rutaPdf));
        
        return $rutaPdf;
    }
}