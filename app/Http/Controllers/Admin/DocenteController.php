<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderBy('orden')->get();
        return view('admin.docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'orden' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nombres', 'cargo', 'bio']);
        $data['orden'] = $request->input('orden', 0);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        Docente::create($data);

        return redirect()->route('admin.docentes.index')->with('status', 'Docente agregado correctamente.');
    }
public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'orden' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nombres', 'cargo', 'bio']);
        $data['orden'] = $request->input('orden', 0);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        $docente->update($data);

        return redirect()->route('admin.docentes.index')->with('status', 'Docente actualizado correctamente.');
    }
    public function destroy(Docente $docente)
    {
        $docente->delete();
        return back()->with('status', 'Docente eliminado.');
    }
}