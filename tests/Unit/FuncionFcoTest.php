<?php

namespace Tests\Unit;

use App\Services\FuncionFco;
use Tests\TestCase;

class FuncionFcoTest extends TestCase
{
    protected FuncionFco $funcionFco;

    protected function setUp(): void
    {
        parent::setUp();
        $this->funcionFco = new FuncionFco;
    }

    public function test_valida_datos_correctos()
    {
        $datos = [
            'nombre' => 'Francisco Pérez',
            'email' => 'francisco@ejemplo.com',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertTrue($resultado['valido']);
        $this->assertEmpty($resultado['errores']);
        $this->assertEquals('Francisco Pérez', $resultado['datos']['nombre']);
        $this->assertEquals('francisco@ejemplo.com', $resultado['datos']['email']);
        $this->assertEquals(25, $resultado['datos']['edad']);
    }

    public function test_rechaza_nombre_corto()
    {
        $datos = [
            'nombre' => 'Jo',
            'email' => 'juan@ejemplo.com',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('nombre', $resultado['errores']);
        $this->assertEquals('El nombre debe tener al menos 3 caracteres', $resultado['errores']['nombre']);
    }

    public function test_rechaza_email_invalido()
    {
        $datos = [
            'nombre' => 'Francisco',
            'email' => 'email-invalido',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('email', $resultado['errores']);
    }

    public function test_rechaza_edad_menor_a_18()
    {
        $datos = [
            'nombre' => 'Francisco',
            'email' => 'francisco@ejemplo.com',
            'edad' => 15,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('edad', $resultado['errores']);
        $this->assertEquals('La edad debe estar entre 18 y 100 años', $resultado['errores']['edad']);
    }

    public function test_rechaza_edad_mayor_a_100()
    {
        $datos = [
            'nombre' => 'Francisco',
            'email' => 'francisco@ejemplo.com',
            'edad' => 150,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('edad', $resultado['errores']);
    }

    public function test_rechaza_nombre_vacio()
    {
        $datos = [
            'nombre' => '',
            'email' => 'francisco@ejemplo.com',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('nombre', $resultado['errores']);
    }

    public function test_sanitiza_email_a_minusculas()
    {
        $datos = [
            'nombre' => 'Francisco',
            'email' => 'FRANCISCO@EJEMPLO.COM',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertTrue($resultado['valido']);
        $this->assertEquals('francisco@ejemplo.com', $resultado['datos']['email']);
    }

    public function test_sanitiza_nombre_eliminando_etiquetas_html()
    {
        $datos = [
            'nombre' => '<script>Francisco</script>',
            'email' => 'francisco@ejemplo.com',
            'edad' => 25,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertTrue($resultado['valido']);
        $this->assertEquals('Francisco', $resultado['datos']['nombre']);
    }

    public function test_rechaza_multiples_errores()
    {
        $datos = [
            'nombre' => 'Jo',
            'email' => 'email-invalido',
            'edad' => 10,
        ];

        $resultado = $this->funcionFco->validarDatosUsuario($datos);

        $this->assertFalse($resultado['valido']);
        $this->assertArrayHasKey('nombre', $resultado['errores']);
        $this->assertArrayHasKey('email', $resultado['errores']);
        $this->assertArrayHasKey('edad', $resultado['errores']);
        $this->assertCount(3, $resultado['errores']);
    }
}
