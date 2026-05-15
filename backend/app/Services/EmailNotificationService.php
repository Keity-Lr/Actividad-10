<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EmailNotificationService 
{
    public function enviarConfirmacion($animal, $ranchoId) 
    {
        // Extraemos la búsqueda del propietario y el envío del correo [cite: 58, 64]
        $propietario = DB::table('propietarios')->where('rancho_id', $ranchoId)->first();
        
        $cuerpoEmail = "<h1>Registro exitoso</h1><p>Animal: {$animal->nombre}</p>";

        Mail::raw($cuerpoEmail, function ($message) use ($propietario) {
            $message->to($propietario->email)
                    ->subject('BovWeight CR Nuevo animal registrado');
        });
    }
}