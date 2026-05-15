<?php
namespace App\Contracts;

interface IReporteStrategy {
    public function generar(int $fincaId): array;
    }