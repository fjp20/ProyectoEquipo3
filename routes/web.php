<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DescuentoController;
use App\Services\FuncionFco;

Route::get('/', function () {
    return 'OK';
});

// Ruta existente del equipo (mantén si DescuentoController existe)
Route::get('/descuento/{precio}/{tipo?}', [DescuentoController::class, 'aplicarDescuento']);

// Ruta rápida para probar la validación via POST /validar-usuario
Route::post('/validar-usuario', function (Request $request) {
    $service = new FuncionFco();
    $datos = $request->only(['nombre', 'email', 'edad']);
    return response()->json($service->validarDatosUsuario($datos));
});