<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with('cicloInteres')->orderByDesc('created_at')->get();
        return view('admin.inscripciones.index', compact('inscripciones'));
    }

    public function marcarContactado(Inscripcion $inscripcion)
    {
        $inscripcion->update(['estado' => 'contactado']);
        return back()->with('status', 'Marcada como contactada.');
    }

    public function marcarMatriculado(Inscripcion $inscripcion)
    {
        $inscripcion->update([
            'estado' => 'matriculado',
            'fecha_matricula' => now(),
        ]);
        return back()->with('status', 'Marcada como matriculada.');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return back()->with('status', 'Inscripción eliminada.');
    }
}