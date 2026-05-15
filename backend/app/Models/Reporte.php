<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'user_id',
        'tipo',
        'archivo_url',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];

    // 🔗 Relaciones

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}