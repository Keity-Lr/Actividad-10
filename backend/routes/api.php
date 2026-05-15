<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesajeController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\AnimalController;


// RUTAS DE PESAJE
Route::prefix('pesajes')->group(function () {

    Route::get('/', [PesajeController::class, 'listar']);
    Route::get('/animal/{animal_id}', [PesajeController::class, 'obtenerPorAnimal']);
    Route::post('/', [PesajeController::class, 'crear']);
    Route::get('/{id}', [PesajeController::class, 'obtener']);
    Route::put('/{id}', [PesajeController::class, 'actualizar']);
    Route::delete('/{id}', [PesajeController::class, 'eliminar']);
//--------------------------------------

});

Route::prefix('fincas')->group(function () {

    Route::post('/', [FincaController::class, 'crearFinca']);
    Route::get('/', [FincaController::class, 'listarFincas']);
    Route::get('/{id}', [FincaController::class, 'obtenerFinca']);
    Route::put('/{id}', [FincaController::class, 'actualizarFinca']);
    Route::delete('/{id}', [FincaController::class, 'eliminarFinca']);
    Route::get('/usuario/{id}', [FincaController::class, 'obtenerFincasPorUsuario']);
});

// RUTAS DE REPORTE
Route::prefix('reportes')->group(function () {

    Route::get('/', [ReporteController::class, 'listar']);
    Route::get('/usuario/{user_id}', [ReporteController::class, 'obtenerPorUsuario']);
    Route::post('/', [ReporteController::class, 'crear']);
    Route::get('/{id}', [ReporteController::class, 'obtener']);
    Route::put('/{id}', [ReporteController::class, 'actualizar']);
    Route::delete('/{id}', [ReporteController::class, 'eliminar']);

});

// RUTAS DE IMAGEN
Route::prefix('imagenes')->group(function () {

    Route::get('/', [ImagenController::class, 'listar']);
    Route::get('/animal/{animal_id}', [ImagenController::class, 'obtenerPorAnimal']);
    Route::post('/', [ImagenController::class, 'crear']);
    Route::get('/{id}', [ImagenController::class, 'obtener']);
    Route::put('/{id}', [ImagenController::class, 'actualizar']);
    Route::delete('/{id}', [ImagenController::class, 'eliminar']);

});

// RUTAS DE ANIMALES
Route::prefix('animales')->group(function () {

    Route::post('/', [AnimalController::class, 'crear']);
    Route::get('/', [AnimalController::class, 'listar']);
    Route::get('/arete/{arete}', [AnimalController::class, 'buscarPorArete']);
    Route::get('/{id}/historial', [AnimalController::class, 'historial']);
    Route::get('/{id}', [AnimalController::class, 'obtener']);
    Route::put('/{id}', [AnimalController::class, 'actualizar']);
    Route::delete('/{id}', [AnimalController::class, 'eliminar']);

});