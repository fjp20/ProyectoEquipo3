<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CuponController extends Controller
{
   public function generar(Request $request)
{
    $request->validate([
        'longitud'   => 'required|integer|min:4|max:20',
        'descuento'  => 'required|integer|min:1|max:90',
        'dias'       => 'required|integer|min:1|max:365',
        'prefijo'    => 'nullable|string|max:5'
    ]);

    $longitud = (int) $request->longitud;
    $descuento = (int) $request->descuento;
    $dias = (int) $request->dias;
    $prefijo = strtoupper($request->prefijo ?? '');

    $random = Str::upper(Str::random($longitud));

    $codigo = $prefijo ? "$prefijo-$random" : $random;

    $expira = Carbon::now()->addDays($dias)->toDateString();

    return response()->json([
        'codigo' => $codigo,
        'descuento' => $descuento,
        'expira' => $expira,
    ]);
}
}
