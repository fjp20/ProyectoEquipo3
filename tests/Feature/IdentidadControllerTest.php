<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class IdentidadControllerTest extends TestCase
{
    // ----------------------------
    // CURP Tests
    // ----------------------------

    #[Test]
    public function validar_curp_valida_correctamente_una_curp_valida(): void
    {
        $response = $this->getJson('/validar-curp?curp=GARC850101HMCLNS09');

        $response->assertStatus(200)
                 ->assertJson([
                     'curp' => 'GARC850101HMCLNS09',
                     'valido' => true,
                 ]);
    }

    #[Test]
    public function validar_curp_rechaza_una_curp_invalida(): void
    {
        // CURP de 18 caracteres pero inválida según regex
        $response = $this->getJson('/validar-curp?curp=XXXX850101HMCLNS09');

        $response->assertStatus(200)
                 ->assertJson([
                     'curp' => 'XXXX850101HMCLNS09',
                     'valido' => false,
                 ]);
    }

    #[Test]
    public function validar_curp_requiere_el_campo_curp(): void
    {
        $response = $this->getJson('/validar-curp');

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['curp']);
    }

    #[Test]
    public function validar_curp_requiere_18_caracteres(): void
    {
        $response = $this->getJson('/validar-curp?curp=SHORTCURP123');

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['curp']);
    }

    // ----------------------------
    // RFC Tests
    // ----------------------------

    #[Test]
    public function validar_rfc_valida_correctamente_un_rfc_valido(): void
    {
        $response = $this->getJson('/validar-rfc?rfc=GARC850101ABC');

        $response->assertStatus(200)
                 ->assertJson([
                     'rfc' => 'GARC850101ABC',
                     'valido' => true,
                 ]);
    }

    #[Test]
    public function validar_rfc_rechaza_un_rfc_invalido(): void
    {
        // RFC de longitud correcta pero inválido según regex
        $response = $this->getJson('/validar-rfc?rfc=XXX850101ABC');

        $response->assertStatus(200)
                 ->assertJson([
                     'rfc' => 'XXX850101ABC',
                     'valido' => false,
                 ]);
    }

    #[Test]
    public function validar_rfc_requiere_el_campo_rfc(): void
    {
        $response = $this->getJson('/validar-rfc');

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['rfc']);
    }

    #[Test]
    public function validar_rfc_requiere_longitud_valida(): void
    {
        $response = $this->getJson('/validar-rfc?rfc=SHORTRFC');

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['rfc']);
    }
}
