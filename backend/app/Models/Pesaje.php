<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;
use App\Models\Imagen;
use App\Models\FuentePesaje;

class Pesaje extends Model
{
    protected $table = 'pesajes';

    protected $fillable = [
        'animal_id',
        'peso_estimado',
        'peso_real',
        'fecha',
        'fuente_id'
    ];

    protected $casts = [
        'peso_estimado' => 'decimal:2',
        'peso_real' => 'decimal:2',
        'fecha' => 'date'
    ];

    // 🔗 Relaciones

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function fuente()
    {
        return $this->belongsTo(FuentePesaje::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }
}