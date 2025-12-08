<?php

namespace App\Services;

class NivelRiesgo
{
    public function calcularRiesgo(int $edad, float $ingresos, int $deudas, bool $historialNegativo): string
    {
        $puntaje = 0;

        if ($edad < 25) {
            $puntaje += 2;
        }

        if ($ingresos < 10000) {
            $puntaje += 3;
        }

        if ($deudas > 5) {
            $puntaje += 3;
        }

        if ($historialNegativo) {
            $puntaje += 4;
        }

        return match (true) {
            $puntaje >= 8 => 'ALTO',
            $puntaje >= 4 => 'MEDIO',
            default => 'BAJO',
        };
    }
}
