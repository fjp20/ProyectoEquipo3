<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\IdentidadController;

Route::get('/', function () {
    return view('welcome'); 
});
Route::get('/generar-cupon', [CuponController::class, 'generar']);
Route::get('/validar-curp', [IdentidadController::class, 'validarCURP']);
Route::get('/validar-rfc', [IdentidadController::class, 'validarRFC']);
Route::get('/validaciones', function () {
    return view('validaciones');
});
