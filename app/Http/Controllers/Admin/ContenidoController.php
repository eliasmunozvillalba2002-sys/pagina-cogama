<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ContenidoInstitucional;

class ContenidoController extends Controller
{
    public function edit()
    {
        $contenido = ContenidoInstitucional::pluck('valor', 'clave');
        return view('admin.contenido.edit', compact('contenido'));
    }

    public function update(Request $request)
    {
        $camposImagen = [
            'bandera_imagen', 'escudo_imagen', 'imagen_portada',
            'carrusel_oficina_imagen', 'carrusel_sede_imagen',
        ];

        $camposTexto = [
            'nombre_colegio', 'lema', 'bienvenida', 'mision', 'vision',
            'filosofia', 'politica_calidad', 'perfil_estudiante',
            'correo_contacto', 'telefono', 'whatsapp', 'direccion', 'horario_secretaria',
            'himno_texto', 'parte_legal', 'horario_clases',
        ];

        foreach ($camposTexto as $clave) {
            ContenidoInstitucional::updateOrCreate(
                ['clave' => $clave],
                ['valor' => $request->input($clave)]
            );
        }

        foreach ($camposImagen as $clave) {
            $archivoActual = ContenidoInstitucional::where('clave', $clave)->value('valor');
            $valor = $archivoActual;

            if ($request->hasFile($clave)) {
                if (!empty($archivoActual) && Storage::disk('public')->exists($archivoActual)) {
                    Storage::disk('public')->delete($archivoActual);
                }

                $archivo = $request->file($clave);
                $nombreArchivo = Str::uuid()->toString() . '.' . $archivo->getClientOriginalExtension();
                $valor = $archivo->storeAs('institucional', $nombreArchivo, 'public');
            }

            if ($request->boolean('eliminar_' . $clave)) {
                if (!empty($archivoActual) && Storage::disk('public')->exists($archivoActual)) {
                    Storage::disk('public')->delete($archivoActual);
                }
                $valor = '';
            }

            ContenidoInstitucional::updateOrCreate(
                ['clave' => $clave],
                ['valor' => $valor]
            );
        }

        return back()->with('status', 'Contenido actualizado correctamente.');
    }
}