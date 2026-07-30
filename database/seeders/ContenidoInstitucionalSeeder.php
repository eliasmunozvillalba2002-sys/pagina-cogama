<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContenidoInstitucional;

class ContenidoInstitucionalSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'nombre_colegio' => 'Colegio Gabriel García Márquez (COGAMA)',
            'lema' => '',
            'bienvenida' => '',
            'mision' => '',
            'vision' => '',
            'correo_contacto' => '',
            'telefono' => '',
            'whatsapp' => '',
            'direccion' => '',
            'horario_secretaria' => '',
            'imagen_portada' => '',
            'inscripciones_habilitadas' => '1',
        ];

        foreach ($items as $clave => $valor) {
            ContenidoInstitucional::updateOrCreate(
                ['clave' => $clave],
                ['valor' => $valor]
            );
        }
    }
}