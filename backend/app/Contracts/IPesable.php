<?php
namespace App\Contracts;
use App\Models\Pesaje;

interface IPesable {
    public function agregarRegistroPeso(Pesaje $registro): void;
    public function calcularGananciaDiariaPromedio(): float;
}