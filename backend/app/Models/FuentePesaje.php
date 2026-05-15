<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesaje;

class FuentePesaje extends Model
{
    protected $table = 'fuentes_pesaje';

    protected $fillable = ['nombre'];

    // 🔗 Relaciones

    public function pesajes()
    {
        return $this->hasMany(Pesaje::class);
    }
}