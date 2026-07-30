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
        $campos = [
            'nombre_colegio', 'lema', 'bienvenida', 'mision', 'vision',
            'filosofia', 'politica_calidad', 'perfil_estudiante',
            'correo_contacto', 'telefono', 'whatsapp', 'direccion', 'horario_secretaria',
            'bandera_imagen', 'escudo_imagen', 'imagen_portada', 'himno_texto', 'parte_legal',
        ];

        foreach ($campos as $clave) {
            $valor = $request->input($clave);

            if ($request->hasFile($clave)) {
                $archivoActual = ContenidoInstitucional::where('clave', $clave)->value('valor');

                if (!empty($archivoActual) && Storage::disk('public')->exists($archivoActual)) {
                    Storage::disk('public')->delete($archivoActual);
                }

                $archivo = $request->file($clave);
                $nombreArchivo = Str::uuid()->toString() . '.' . $archivo->getClientOriginalExtension();
                $valor = $archivo->storeAs('institucional', $nombreArchivo, 'public');
            }

            if ($clave === 'imagen_portada' && $request->boolean('eliminar_imagen_portada')) {
                $archivoActual = ContenidoInstitucional::where('clave', $clave)->value('valor');

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