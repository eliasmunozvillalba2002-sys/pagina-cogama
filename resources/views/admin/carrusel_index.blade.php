@extends('layouts.admin')

@section('title', 'Carrusel')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-600 text-sm">Gestiona las diapositivas del carrusel (imagen, título, horario/dirección si aplica).</p>
    <a href="{{ route('admin.carrusel.create') }}"
       class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-5 py-2.5 rounded-lg transition text-sm">
        + Nueva diapositiva
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-6 py-3">Vista previa</th>
                <th class="px-6 py-3">Título / Subtítulo</th>
                <th class="px-6 py-3">Tipo</th>
                <th class="px-6 py-3">Orden</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr class="border-t border-slate-100">
                <td class="px-6 py-3">
                    <img src="{{ asset('storage/' . $item->imagen) }}" alt="{{ $item->titulo ?? 'Diapositiva' }}" class="w-28 h-16 object-cover rounded-lg">
                </td>
                <td class="px-6 py-3 text-slate-700">
                    <div class="font-semibold">{{ $item->titulo }}</div>
                    <div class="text-sm text-slate-500">{{ $item->subtitulo }}</div>
                </td>
                <td class="px-6 py-3 text-slate-500">{{ ucfirst($item->tipo) }}</td>
                <td class="px-6 py-3 text-slate-500">{{ $item->orden }}</td>
                <td class="px-6 py-3 text-right">
                    <a href="{{ route('admin.carrusel.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium mr-4">Editar</a>
                    <form method="POST" action="{{ route('admin.carrusel.destroy', $item->id) }}" class="inline" onsubmit="return confirm('¿Eliminar esta diapositiva?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-slate-400">Aún no hay diapositivas en el carrusel.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
