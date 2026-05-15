<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Finca;
use App\Models\Reporte;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔥 Opcional (nivel pro)
    const ROL_ADMIN = 'admin';
    const ROL_GANADERO = 'ganadero';
    const ROL_VETERINARIO = 'veterinario';

    // 🔗 Relaciones

    public function fincas()
    {
        return $this->hasMany(Finca::class);
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }
}