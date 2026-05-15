<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\AnimalService;
use App\Services\EmailNotificationService;
use App\Services\AnimalPdfGenerator;
use App\Models\Animal;
use App\Models\Finca;
use App\Models\Raza;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class AnimalServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_de_animal_llama_a_servicios_externos()
    {
        // 1. Creamos la base de datos necesaria para que no fallen las llaves foráneas
        $user = User::factory()->create(); // Crea un usuario
        $finca = Finca::create([
            'nombre' => 'Finca Test',
            'user_id' => $user->id // Esto arregla el error de tu imagen
        ]);
        $raza = Raza::create(['nombre' => 'Brahman']);

        // 2. Mocks de los servicios que creamos para SRP
        $notificadorMock = Mockery::mock(EmailNotificationService::class);
        $pdfMock = Mockery::mock(AnimalPdfGenerator::class);

        // Definimos que esperamos que se llamen una vez
        $notificadorMock->shouldReceive('enviarConfirmacion')->once();
        $pdfMock->shouldReceive('generarRegistroPdf')->once()->andReturn('registros/test.pdf');

        // 3. Instanciamos el servicio con los mocks
        $service = new AnimalService($notificadorMock, $pdfMock);

        // 4. Datos exactos que pide tu modelo Animal
        $datos = [
            'numero_arete'     => '1234',
            'nombre'           => 'Lola',
            'raza_id'          => $raza->id,
            'fecha_nacimiento' => '2024-01-01',
            'finca_id'         => $finca->id,
            'estado'           => 1,
        ];

        // 5. Ejecución
        $resultado = $service->registrar($datos);

        // 6. Verificaciones finales
        $this->assertInstanceOf(Animal::class, $resultado);
        $this->assertEquals('registros/test.pdf', $resultado->ruta_pdf_registro);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}