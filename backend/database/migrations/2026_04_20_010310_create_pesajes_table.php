<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesajes', function (Blueprint $table) {
            $table->id();

            // Relación con animal
            $table->foreignId('animal_id')
                  ->constrained('animales')
                  ->cascadeOnDelete();

            $table->decimal('peso_estimado', 8, 2);
            $table->decimal('peso_real', 8, 2)->nullable();

            $table->date('fecha');

            // 🔥 CAMBIO IMPORTANTE (normalización)
            $table->foreignId('fuente_id')
                  ->nullable()
                  ->constrained('fuentes_pesaje')
                  ->nullOnDelete();

            // Índices
            $table->index('fecha');
            $table->index('animal_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesajes');
    }
};