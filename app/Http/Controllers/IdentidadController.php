<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentidadController extends Controller
{
    public function validarCURP(Request $request)
    {
        $request->validate([
            'curp' => 'required|string|size:18'
        ]);

        $curp = strtoupper($request->curp);

        // Expresión regular oficial del RENAPO
        $regex = "/^[A-Z]{4}\d{6}[HM][A-Z]{5}[0-9A-Z]\d$/";

        $esValido = preg_match($regex, $curp) === 1;

        return response()->json([
            'curp' => $curp,
            'valido' => $esValido
        ]);
    }

    public function validarRFC(Request $request)
    {
        $request->validate([
            'rfc' => 'required|string|min:12|max:13'
        ]);

        $rfc = strtoupper($request->rfc);

        // RFC Persona Física o Moral
        $regex = "/^([A-ZÑ&]{3,4})(\d{6})([A-Z0-9]{3})$/";

        $esValido = preg_match($regex, $rfc) === 1;

        return response()->json([
            'rfc' => $rfc,
            'valido' => $esValido
        ]);
    }
}
