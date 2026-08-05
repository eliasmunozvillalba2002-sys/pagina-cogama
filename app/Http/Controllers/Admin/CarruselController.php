<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrusel;
use Illuminate\Support\Facades\Storage;

class CarruselController extends Controller
{
    public function index()
    {
        $items = Carrusel::orderBy('orden')->orderByDesc('created_at')->get();
        return view('admin.carrusel_index', compact('items'));
    }

    public function create()
    {
        return view('admin.carrusel_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'nullable|string|max:255',
            'subtitulo' => 'nullable|string|max:500',
            'imagen' => 'required|image|max:5120',
            'tipo' => 'nullable|in:oficina,sede,general',
            'horario' => 'nullable|string|max:1000',
            'direccion' => 'nullable|string|max:1000',
            'orden' => 'nullable|integer',
            'activo' => 'nullable|boolean',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('carrusel', 'public');
            $data['imagen'] = $path;
        }

        $data['activo'] = $request->has('activo');
        $data['orden'] = $request->input('orden', 0);

        Carrusel::create($data);

        return redirect()->route('admin.carrusel.index')->with('status', 'Elemento de carrusel creado.');
    }

    public function edit(Carrusel $carrusel)
    {
        return view('admin.carrusel_edit', compact('carrusel'));
    }

    public function update(Request $request, Carrusel $carrusel)
    {
        $data = $request->validate([
            'titulo' => 'nullable|string|max:255',
            'subtitulo' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|max:5120',
            'tipo' => 'nullable|in:oficina,sede,general',
            'horario' => 'nullable|string|max:1000',
            'direccion' => 'nullable|string|max:1000',
            'orden' => 'nullable|integer',
            'activo' => 'nullable|boolean',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        if ($request->hasFile('imagen')) {
            // eliminar anterior si existe
            if ($carrusel->imagen && Storage::disk('public')->exists($carrusel->imagen)) {
                Storage::disk('public')->delete($carrusel->imagen);
            }
            $path = $request->file('imagen')->store('carrusel', 'public');
            $data['imagen'] = $path;
        }

        $data['activo'] = $request->has('activo');
        $data['orden'] = $request->input('orden', 0);

        $carrusel->update($data);

        return redirect()->route('admin.carrusel.index')->with('status', 'Elemento de carrusel actualizado.');
    }

    public function destroy(Carrusel $carrusel)
    {
        if ($carrusel->imagen && Storage::disk('public')->exists($carrusel->imagen)) {
            Storage::disk('public')->delete($carrusel->imagen);
        }
        $carrusel->delete();
        return back()->with('status', 'Elemento eliminado.');
    }
}
