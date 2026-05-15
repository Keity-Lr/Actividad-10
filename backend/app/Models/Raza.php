<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;

class Raza extends Model
{
    protected $table = 'razas';

    protected $fillable = ['nombre'];

    // 🔥 Opcional (si no usas timestamps en catálogo)
    // public $timestamps = false;

    // 🔗 Relaciones

    public function animales()
    {
        return $this->hasMany(Animal::class);
    }
}