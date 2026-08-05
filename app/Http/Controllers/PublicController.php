<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ContenidoInstitucional;
use App\Models\Publicacion;
use App\Models\Ciclo;

class PublicController extends Controller
{
    private function resolverContenidoInstitucional(array $contenido): array
    {
        foreach (['bandera_imagen', 'escudo_imagen', 'imagen_portada'] as $clave) {
            if (!empty($contenido[$clave])) {
                $contenido[$clave] = $this->resolverUrlImagen($contenido[$clave]);
            }
        }

        return $contenido;
    }

    private function resolverUrlImagen(?string $valor): ?string
    {
        if (empty($valor)) {
            return null;
        }

        if (Str::startsWith($valor, ['http://', 'https://'])) {
            return $valor;
        }

        $ruta = ltrim($valor, '/');

        if (Storage::disk('public')->exists($ruta)) {
            return Storage::url($ruta);
        }

        $rutaInstitucional = 'institucional/' . basename($ruta);
        if (Storage::disk('public')->exists($rutaInstitucional)) {
            return Storage::url($rutaInstitucional);
        }

        return asset('storage/' . $ruta);
    }

    public function quienesSomos()
    {
        $contenido = $this->resolverContenidoInstitucional(ContenidoInstitucional::pluck('valor', 'clave')->toArray());
        return view('quienes-somos', compact('contenido'));
    }
    public function docentes()
    {
        $docentes = \App\Models\Docente::orderBy('orden')->get();
        return view('docentes', compact('docentes'));
    }
    public function modeloClei()
    {
        return view('modelo-clei');
    }
    public function contacto()
    {
        $contenido = $this->resolverContenidoInstitucional(\App\Models\ContenidoInstitucional::pluck('valor', 'clave')->toArray());
        return view('contacto', compact('contenido'));
    }

    public function galeria()
    {
        $imagenes = \App\Models\Galeria::orderBy('orden')->orderByDesc('created_at')->get();
        return view('galeria', compact('imagenes'));
    }

    public function inicio()
    {
        $contenido = $this->resolverContenidoInstitucional(ContenidoInstitucional::pluck('valor', 'clave')->toArray());
        $publicaciones = Publicacion::where('publicado', true)
            ->orderByDesc('fecha_publicacion')
            ->take(3)
            ->get();

        // Preferir diapositivas administradas en Carrusel para el hero/carrusel principal si existen
        $carruselSlides = \App\Models\Carrusel::where('activo', true)
            ->orderBy('orden')
            ->orderByDesc('created_at')
            ->get();

        return view('inicio', compact('contenido', 'publicaciones', 'carruselSlides'));
    }

    // Página pública dedicada al carrusel (sección independiente)
    public function carruselPage()
    {
        $contenido = $this->resolverContenidoInstitucional(ContenidoInstitucional::pluck('valor', 'clave')->toArray());

        $slides = \App\Models\Carrusel::where('activo', true)
            ->orderBy('orden')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('tipo');

        // $slides es un collection agrupada por tipo: 'general','oficina','sede'
        return view('carrusel', compact('contenido', 'slides'));
    }
}