<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;

class ConsultaNotasController extends Controller
{
    public function formulario()
    {
        return view('consultar-notas');
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'documento' => 'required|string',
        ]);

        $estudiante = Estudiante::where('documento', $request->documento)->first();

        if (! $estudiante) {
            return back()->withErrors(['documento' => 'No encontramos ningún estudiante con ese documento.']);
        }

        $notas = $estudiante->notas()->with(['ciclo', 'asignatura'])->orderBy('periodo')->get();

        return view('consultar-notas', compact('estudiante', 'notas'));
    }
}