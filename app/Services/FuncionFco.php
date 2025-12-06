<?php

namespace App\Services;

class FuncionFco
{
    /**
     * Valida y sanitiza datos de un usuario
     * 
     * @param array $datos
     * @return array
     */
    public function validarDatosUsuario(array $datos): array
    {
        $errores = [];
        $datosSanitizados = [];

        // Validar nombre
        if (empty($datos['nombre']) || strlen($datos['nombre']) < 3) {
            $errores['nombre'] = 'El nombre debe tener al menos 3 caracteres';
        } else {
            $datosSanitizados['nombre'] = trim(strip_tags($datos['nombre']));
        }

        // Validar email
        if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email inválido';
        } else {
            $datosSanitizados['email'] = strtolower(trim($datos['email']));
        }

        // Validar edad
        if (!isset($datos['edad']) || $datos['edad'] < 18 || $datos['edad'] > 100) {
            $errores['edad'] = 'La edad debe estar entre 18 y 100 años';
        } else {
            $datosSanitizados['edad'] = (int) $datos['edad'];
        }

        return [
            'valido' => empty($errores),
            'errores' => $errores,
            'datos' => $datosSanitizados
        ];
    }
}