<?php

namespace App\Services;

use App\Models\Animal;
use App\Services\EmailNotificationService;
use App\Services\AnimalPdfGenerator;
use App\Factories\IRazaFactory;
use App\Repositories\IAnimalRepository;

class AnimalService 
{
    protected $notificador;
    protected $pdfService;
    protected $razaFactory;
    protected $animalRepository;

    public function __construct(EmailNotificationService $notificador, AnimalPdfGenerator $pdfService, IRazaFactory $razaFactory, IAnimalRepository $animalRepository) 
    {
        $this->notificador = $notificador;
        $this->pdfService = $pdfService;
        $this->razaFactory = $razaFactory;
        $this->animalRepository = $animalRepository;
    }

    public function registrar(array $datos): Animal 
    {
        // 1. Validaciones de negocio [cite: 35, 36]
        if (empty($datos['numero_arete'])) {
            throw new \InvalidArgumentException('El arete es obligatorio.');
        }

        // 2. Limpieza de datos (Solo enviamos lo que el modelo permite)
        // Esto evita errores si el arreglo trae campos extra como 'peso_inicial_kg'
        $raza = $this->razaFactory->create($datos['raza']);
        $datos['raza_id'] = $raza->id;
        $datosParaGuardar = array_intersect_key($datos, array_flip([
            'numero_arete', 
            'nombre', 
            'raza_id', 
            'fecha_nacimiento', 
            'estado', 
            'finca_id'
        ]));

        $animal = $this->animalRepository->save($datosParaGuardar);

        // 3. Delegación de responsabilidades (SRP) [cite: 13, 82]
        // Usamos los datos originales ($datos) para las notificaciones por si se ocupan IDs externos
        $this->notificador->enviarConfirmacion($animal, $datos['finca_id'] ?? null);
        
        $ruta = $this->pdfService->generarRegistroPdf($animal, $datos['finca_id'] ?? null);
        
        $animal->update(['ruta_pdf_registro' => $ruta]);

        return $animal;
    }
}
