<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();

            // 🔥 RELACIÓN CORRECTA
            $table->foreignId('pesaje_id')
                  ->constrained('pesajes')
                  ->cascadeOnDelete();

            $table->string('url');

            // indica si ya fue procesada por la IA
            $table->boolean('procesada')->default(false);

            // opcional, puedes dejarla nullable
            $table->date('fecha')->nullable();

            // 🔥 índices útiles
            $table->index('pesaje_id');
            $table->index('procesada');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes'); // ✅ CORREGIDO
    }
};