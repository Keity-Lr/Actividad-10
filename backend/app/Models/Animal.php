<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Finca;
use App\Models\Pesaje;
use App\Models\Raza;

class Animal extends Model
{
    protected $table = 'animales';

    protected $fillable = [
        'numero_arete',
        'nombre',
        'raza_id',
        'fecha_nacimiento',
        'estado',
        'finca_id',
        'ruta_pdf_registro',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];

    // 🔗 Relaciones

    public function finca()
    {
        return $this->belongsTo(Finca::class);
    }

    public function pesajes()
    {
        return $this->hasMany(Pesaje::class);
    }

    public function raza()
    {
        return $this->belongsTo(Raza::class);
    }
}