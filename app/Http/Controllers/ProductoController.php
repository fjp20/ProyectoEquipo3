<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Función que filtra productos según el nombre enviado.
     * Recibe datos manuales.
     *
     * @param string $nombre
     * @param array $productos
     * @return array
     */
    public function filtrarProductos(string $nombre, array $productos)
    {
        $resultado = array_filter($productos, function ($p) use ($nombre) {
            return stripos($p['nombre'], $nombre) !== false;
        });

        return array_values($resultado);
    }

    /**
     * Endpoint que llama a la función anterior.
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:2'
        ]);

        $nombre = $request->input('nombre');

        // 👉 AQUÍ TU LE DAS LOS DATOS MANUALMENTE
        $productos = [
            ['id' => 1, 'nombre' => 'skateboard completo'],
            ['id' => 2, 'nombre' => 'playera verde'],
            ['id' => 3, 'nombre' => 'skate pro edición'],
            ['id' => 4, 'nombre' => 'sudadera negra'],
        ];

        return $this->filtrarProductos($nombre, $productos);
    }
}



