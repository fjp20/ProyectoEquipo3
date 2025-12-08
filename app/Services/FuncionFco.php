<?php

namespace App\Services;

class FuncionFco
{
    /**
     * Valida y sanitiza datos de usuario.
     *
     * Retorna:
     *  [
     *    'valido' => bool,
     *    'errores' => array,
     *    'datos' => array
     *  ]
     */
    public function validarDatosUsuario(array $datos): array
    {
        $errores = [];
        $sanitizados = [];

        // Nombre: strip tags, trim
        $rawNombre = $datos['nombre'] ?? '';
        $nombre = trim(strip_tags((string) $rawNombre));
        if ($nombre === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (mb_strlen($nombre) < 3) {
            $errores['nombre'] = 'El nombre debe tener al menos 3 caracteres.';
        }
        $sanitizados['nombre'] = $nombre;

        // Email: lowercase, trim, validate
        $rawEmail = $datos['email'] ?? '';
        $email = mb_strtolower(trim((string) $rawEmail));
        if ($email === '') {
            $errores['email'] = 'El email es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email inválido.';
        }
        $sanitizados['email'] = $email;

        // Edad: nullable -> int, between 18 and 100
        $rawEdad = $datos['edad'] ?? null;
        $edad = (is_null($rawEdad) || $rawEdad === '') ? null : (int) $rawEdad;
        if ($edad === null) {
            $errores['edad'] = 'La edad es obligatoria.';
        } elseif ($edad < 18 || $edad > 100) {
            $errores['edad'] = 'La edad debe estar entre 18 y 100 años.';
        }
        $sanitizados['edad'] = $edad;

        $valido = empty($errores);

        return [
            'valido' => $valido,
            'errores' => $errores,
            'datos' => $sanitizados,
        ];
    }
}