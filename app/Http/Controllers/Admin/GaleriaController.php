<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        $imagenes = Galeria::orderBy('orden')->orderByDesc('created_at')->get();
        return view('admin.galeria.index', compact('imagenes'));
    }

    public function create()
    {
        return view('admin.galeria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => ['required', 'image', 'max:2048'],
            'descripcion' => ['nullable', 'string'],
            'orden' => ['nullable', 'integer'],
        ]);

        $data = [
            'descripcion' => $request->input('descripcion'),
            'orden' => $request->input('orden', 0),
        ];

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('galeria', 'public');
        }

        Galeria::create($data);

        return redirect()->route('admin.galeria.index')->with('status', 'Imagen agregada a la galería.');
    }

    public function destroy(Galeria $galeria)
    {
        $galeria->delete();
        return back()->with('status', 'Imagen eliminada de la galería.');
    }
}
