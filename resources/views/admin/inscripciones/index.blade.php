@extends('layouts.admin')

@section('title', 'Inscripciones')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-6 py-3">Nombre</th>
                <th class="px-6 py-3">Tipo de Documento</th>
                <th class="px-6 py-3">Documento</th>
                <th class="px-6 py-3">Teléfono</th>
                <th class="px-6 py-3">Ciclo</th>
                <th class="px-6 py-3">Fecha</th>
                <th class="px-6 py-3">Estado</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscripciones as $ins)
            <tr class="border-t border-slate-100">
                <td class="px-6 py-3 font-medium text-slate-800">{{ $ins->nombres }} {{ $ins->apellidos }}</td>
                <td class="px-6 py-3">{{ $ins->tipo_documento }}</td>
                <td class="px-6 py-3">{{ $ins->documento }}</td>
                <td class="px-6 py-3">
                    <a href="https://wa.me/57{{ preg_replace('/\D/', '', $ins->telefono) }}" target="_blank" class="text-blue-700 hover:underline">
                        {{ $ins->telefono }}
                    </a>
                </td>
                <td class="px-6 py-3">{{ $ins->cicloInteres->nombre ?? '—' }}</td>
                <td class="px-6 py-3 text-slate-500">{{ $ins->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-3">
                    @if($ins->estado === 'pendiente')
                        <span class="text-yellow-700 bg-yellow-50 px-2.5 py-1 rounded-full text-xs font-medium">Pendiente</span>
                    @elseif($ins->estado === 'contactado')
                        <span class="text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full text-xs font-medium">Contactado</span>
                    @else
                        <span class="text-green-700 bg-green-50 px-2.5 py-1 rounded-full text-xs font-medium">Matriculado</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right space-x-3">
                    @if($ins->estado === 'pendiente')
                        <form method="POST" action="{{ route('admin.inscripciones.contactado', $ins->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-blue-700 hover:text-blue-900 text-xs font-medium">Marcar contactado</button>
                        </form>
                    @endif
                    @if($ins->estado === 'contactado')
                        <form method="POST" action="{{ route('admin.inscripciones.matriculado', $ins->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-700 hover:text-green-900 text-xs font-medium">Marcar matriculado</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.inscripciones.destroy', $ins->id) }}" class="inline"
                          onsubmit="return confirm('¿Eliminar esta inscripción?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-slate-400">Aún no hay inscripciones.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection