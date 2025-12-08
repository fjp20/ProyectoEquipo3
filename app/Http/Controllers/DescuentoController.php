<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    public function aplicarDescuento(Request $request, $precio)
    {
        $tipo = $request->query('tipo');

        if (!is_numeric($precio) || $precio <= 0) {
            return response()->json([
                'error' => 'El precio debe ser un número mayor a 0'
            ], 422);
        }

        if (!in_array($tipo, ['estudiante', 'vip'])) {
            return response()->json([
                'error' => 'El tipo debe ser estudiante o vip'
            ], 422);
        }

        $descuento = 0;

        if ($tipo === 'estudiante') {
            $descuento = $precio * 0.20; // 20%
        } elseif ($tipo === 'vip') {
            $descuento = $precio * 0.40; // 40%
        }

        return response()->json([
            'precio_original' => $precio,
            'tipo' => $tipo,
            'descuento' => $descuento,
            'precio_final' => $precio - $descuento
        ]);
    }
}