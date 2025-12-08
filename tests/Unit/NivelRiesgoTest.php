<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\NivelRiesgo;

class NivelRiesgoTest extends TestCase
{
    public function test_riesgo_alto()
    {
        $service = new NivelRiesgo();

        $resultado = $service->calcularRiesgo(22, 8000, 6, true);

        $this->assertEquals('ALTO', $resultado);
    }

    public function test_riesgo_medio()
    {
        $service = new NivelRiesgo();
        $resultado = $service->calcularRiesgo(30, 12000, 3, true);

        $this->assertEquals('MEDIO', $resultado);
    }

    public function test_riesgo_bajo()
    {
        $service = new NivelRiesgo();

        $resultado = $service->calcularRiesgo(40, 25000, 0, false);

        $this->assertEquals('BAJO', $resultado);
    }
}
