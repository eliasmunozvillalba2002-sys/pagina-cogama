<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::orderByDesc('fecha_publicacion')->get();
        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('admin.publicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:circular,noticia,promocion',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'publicado' => 'nullable|boolean',
        ]);

        $data = $request->only(['tipo', 'titulo', 'contenido']);
        $data['publicado'] = $request->boolean('publicado');
        $data['fecha_publicacion'] = now();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        Publicacion::create($data);

        return redirect()->route('admin.publicaciones.index')->with('status', 'Publicación creada correctamente.');
    }

    public function edit(Publicacion $publicacione)
    {
        return view('admin.publicaciones.edit', compact('publicacione'));
    }

    public function update(Request $request, Publicacion $publicacione)
    {
        $request->validate([
            'tipo' => 'required|in:circular,noticia,promocion',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'publicado' => 'nullable|boolean',
        ]);

        $data = $request->only(['tipo', 'titulo', 'contenido']);
        $data['publicado'] = $request->boolean('publicado');

        if ($request->hasFile('imagen')) {
            // eliminar anterior si existe
            if ($publicacione->imagen && \Illuminate\Support\Facades\Storage::disk('public')->exists($publicacione->imagen)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($publicacione->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $publicacione->update($data);

        return redirect()->route('admin.publicaciones.index')->with('status', 'Publicación actualizada correctamente.');
    }

    public function destroy(Publicacion $publicacione)
    {
        $publicacione->delete();
        return back()->with('status', 'Publicación eliminada.');
    }
}