<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Ciclo;

class InscripcionController extends Controller
{
    public function formulario()
    {
        $ciclos = Ciclo::all();
        $habilitado = optional(\App\Models\ContenidoInstitucional::where('clave', 'inscripciones_habilitadas')->first())->valor ?? '1';

        return view('inscripcion', compact('ciclos', 'habilitado'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'nombres' => trim((string) $request->input('nombres')),
            'apellidos' => trim((string) $request->input('apellidos')),
            'documento' => trim((string) $request->input('documento')),
            'telefono' => trim((string) $request->input('telefono')),
            'email' => trim((string) $request->input('email')),
            'mensaje' => trim((string) $request->input('mensaje')),
        ]);

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|max:50',
            'telefono' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{4,30}$/'],
            'email' => ['nullable', 'email:rfc,dns'],
            'ciclo_interes' => ['nullable', 'string', 'max:50'],
            'mensaje' => ['nullable', 'string', 'max:1000'],
        ]);

        $data = $request->only(['nombres', 'apellidos', 'tipo_documento', 'documento', 'telefono', 'email', 'mensaje']);

        if ($request->filled('ciclo_interes')) {
            $data['ciclo_interes_id'] = Ciclo::where('nombre', $request->ciclo_interes)->value('id');
        }

        Inscripcion::create($data);

        return back()->with('status', '¡Gracias! Hemos recibido tu solicitud de inscripción. Pronto nos pondremos en contacto contigo.');
    }
}