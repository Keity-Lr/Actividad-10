<?php

namespace App\Services;

use App\Models\Animal;
use App\Services\EmailNotificationService;
use App\Services\AnimalPdfGenerator;

class AnimalService 
{
    protected $notificador;
    protected $pdfService;

    public function __construct(EmailNotificationService $notificador, AnimalPdfGenerator $pdfService) 
    {
        $this->notificador = $notificador;
        $this->pdfService = $pdfService;
    }

    public function registrar(array $datos): Animal 
    {
        // 1. Validaciones de negocio [cite: 35, 36]
        if (empty($datos['numero_arete'])) {
            throw new \InvalidArgumentException('El arete es obligatorio.');
        }

        // 2. Limpieza de datos (Solo enviamos lo que el modelo permite)
        // Esto evita errores si el arreglo trae campos extra como 'peso_inicial_kg'
        $datosParaGuardar = array_intersect_key($datos, array_flip([
            'numero_arete', 
            'nombre', 
            'raza_id', 
            'fecha_nacimiento', 
            'estado', 
            'finca_id'
        ]));

        $animal = Animal::create($datosParaGuardar);

        // 3. Delegación de responsabilidades (SRP) [cite: 13, 82]
        // Usamos los datos originales ($datos) para las notificaciones por si se ocupan IDs externos
        $this->notificador->enviarConfirmacion($animal, $datos['finca_id'] ?? null);
        
        $ruta = $this->pdfService->generarRegistroPdf($animal, $datos['finca_id'] ?? null);
        
        $animal->update(['ruta_pdf_registro' => $ruta]);

        return $animal;
    }
}