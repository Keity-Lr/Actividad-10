<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();

            // Relación con usuario
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Tipo de reporte
            $table->string('tipo')->default('general');

            // Ruta del archivo generado
            $table->string('archivo_url')->nullable();

            $table->date('fecha')->nullable();

            // 🔥 Índices
            $table->index('user_id');
            $table->index('fecha');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};