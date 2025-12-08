<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DescuentoController;
use App\Services\FuncionFco;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\IdentidadController;

// ----------------------------
// Ruta raíz para que el test pase
// ----------------------------
Route::get('/', function () {
    return view('welcome'); // o return 'Hola mundo';
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

// Ruta existente del equipo (DescuentoController)
Route::get('/descuento/{precio}/{tipo?}', [DescuentoController::class, 'aplicarDescuento']);

// Ruta rápida para probar la validación via POST /validar-usuario
Route::post('/validar-usuario', function (Request $request) {
    $service = new FuncionFco();
    $datos = $request->only(['nombre', 'email', 'edad']);
    return response()->json($service->validarDatosUsuario($datos));
});