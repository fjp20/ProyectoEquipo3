<?php

namespace Tests\Unit;

use App\Services\FuncionFco;
use Tests\TestCase;

class FuncionFcoTest extends TestCase
{
    protected FuncionFco $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FuncionFco();
    }

    public function test_valida_datos_correctos()
    {
        $datos = [
            'nombre' => 'Francisco Pérez',
            'email' => 'francisco@ejemplo.com',
            'edad' => 25,
        ];

        $res = $this->service->validarDatosUsuario($datos);

        $this->assertTrue($res['valido']);
        $this->assertEmpty($res['errores']);
        $this->assertSame('Francisco Pérez', $res['datos']['nombre']);
        $this->assertSame('francisco@ejemplo.com', $res['datos']['email']);
        $this->assertSame(25, $res['datos']['edad']);
    }

    public function test_rechaza_nombre_corto()
    {
        $res = $this->service->validarDatosUsuario([
            'nombre' => 'Jo',
            'email' => 'juan@ejemplo.com',
            'edad' => 25,
        ]);

        $this->assertFalse($res['valido']);
        $this->assertArrayHasKey('nombre', $res['errores']);
        $this->assertSame('El nombre debe tener al menos 3 caracteres.', $res['errores']['nombre']);
    }

    public function test_rechaza_email_invalido()
    {
        $res = $this->service->validarDatosUsuario([
            'nombre' => 'Francisco',
            'email' => 'email-invalido',
            'edad' => 25,
        ]);

        $this->assertFalse($res['valido']);
        $this->assertArrayHasKey('email', $res['errores']);
        $this->assertSame('Email inválido.', $res['errores']['email']);
    }

    public function test_rechaza_edad_menor_a_18()
    {
        $res = $this->service->validarDatosUsuario([
            'nombre' => 'Francisco',
            'email' => 'francisco@ejemplo.com',
            'edad' => 15,
        ]);

        $this->assertFalse($res['valido']);
        $this->assertArrayHasKey('edad', $res['errores']);
        $this->assertSame('La edad debe estar entre 18 y 100 años.', $res['errores']['edad']);
    }

    public function test_sanitiza_email_y_nombre()
    {
        $res = $this->service->validarDatosUsuario([
            'nombre' => '<b>Francisco</b>',
            'email' => 'FRANCISCO@EJEMPLO.COM',
            'edad' => 30,
        ]);

        $this->assertTrue($res['valido']);
        $this->assertSame('francisco@ejemplo.com', $res['datos']['email']);
        $this->assertSame('Francisco', $res['datos']['nombre']);
    }

    public function test_rechaza_multiplos_errores()
    {
        $res = $this->service->validarDatosUsuario([
            'nombre' => '',
            'email' => 'email-invalido',
            'edad' => 10,
        ]);

        $this->assertFalse($res['valido']);
        $this->assertCount(3, $res['errores']);
        $this->assertArrayHasKey('nombre', $res['errores']);
        $this->assertArrayHasKey('email', $res['errores']);
        $this->assertArrayHasKey('edad', $res['errores']);
    }
}