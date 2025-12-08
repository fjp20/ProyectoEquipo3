<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\IdentidadController;

// ----------------------------
// Ruta raíz para que el test pase
// ----------------------------
Route::get('/', function () {
    return view('welcome'); // o puedes devolver un mensaje simple: return 'Hola mundo';
});

// ----------------------------
// Rutas de Cupones
// ----------------------------
Route::get('/generar-cupon', [CuponController::class, 'generar']);

// ----------------------------
// Rutas de validación de Identidad
// ----------------------------
Route::get('/validar-curp', [IdentidadController::class, 'validarCURP']);
Route::get('/validar-rfc', [IdentidadController::class, 'validarRFC']);

// ----------------------------
// Otras vistas
// ----------------------------
Route::get('/validaciones', function () {
    return view('validaciones');
});
