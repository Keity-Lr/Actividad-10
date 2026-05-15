<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Animal;

class Finca extends Model
{
    protected $table = 'fincas';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'user_id'
    ];

    // 🔗 Relaciones

    public function propietario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function animales()
    {
        return $this->hasMany(Animal::class);
    }
}