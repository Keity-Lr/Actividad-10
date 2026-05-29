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
        
        $user = User::factory()->create();
        $finca = Finca::create([
            'nombre' => 'Finca Test',
            'user_id' => $user->id 
        ]);
        $raza = Raza::create(['nombre' => 'Brahman']);

        // Mocks de los servicios que para SRP
        $notificadorMock = Mockery::mock(EmailNotificationService::class);
        $pdfMock = Mockery::mock(AnimalPdfGenerator::class);

        // Definimos que esperamos que se llamen una vez
        $notificadorMock->shouldReceive('enviarConfirmacion')->once();
        $pdfMock->shouldReceive('generarRegistroPdf')->once()->andReturn('registros/test.pdf');
        $repositoryMock1 = Mockery::mock('alias:App\Repositories\AnimalRepository');
        $repositoryMock2 = Mockery::mock('alias:App\Repositories\FincaRepository');

       
        $service = new AnimalService($notificadorMock, $pdfMock);

        $datos = [
            'numero_arete'     => '1234',
            'nombre'           => 'Lola',
            'raza_id'          => $raza->id,
            'fecha_nacimiento' => '2024-01-01',
            'finca_id'         => $finca->id,
            'estado'           => 1,
        ];

       
        $resultado = $service->registrar($datos);

        
        $this->assertInstanceOf(Animal::class, $resultado);
        $this->assertEquals('registros/test.pdf', $resultado->ruta_pdf_registro);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
