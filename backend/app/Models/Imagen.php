<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesaje;

class Imagen extends Model
{
    protected $table = 'imagenes';

    protected $fillable = [
        'pesaje_id',
        'url',
        'procesada',
        'fecha'
    ];

    protected $casts = [
        'procesada' => 'boolean',
        'fecha' => 'date'
    ];

    // 🔗 Relaciones

    public function pesaje()
    {
        return $this->belongsTo(Pesaje::class);
    }
}