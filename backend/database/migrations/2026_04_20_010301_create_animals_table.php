<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('numero_arete')->unique();
            $table->string('nombre')->nullable();

            // 🔥 CAMBIO IMPORTANTE (normalización)
            $table->foreignId('raza_id')
                  ->nullable()
                  ->constrained('razas')
                  ->nullOnDelete();

            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado')->default('activo');

            // Relación con finca
            $table->foreignId('finca_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Índices
            $table->index('numero_arete');
            $table->index('estado');
            $table->string('ruta_pdf_registro')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};