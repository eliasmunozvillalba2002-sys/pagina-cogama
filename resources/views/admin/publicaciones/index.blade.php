@extends('layouts.admin')

@section('title', 'Publicaciones')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-600 text-sm">Circulares, noticias y promociones que aparecen en la portada.</p>
    <a href="{{ route('admin.publicaciones.create') }}"
       class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-5 py-2.5 rounded-lg transition text-sm">
        + Nueva publicación
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-6 py-3">Tipo</th>
                <th class="px-6 py-3">Título</th>
                <th class="px-6 py-3">Fecha</th>
                <th class="px-6 py-3">Estado</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($publicaciones as $pub)
            <tr class="border-t border-slate-100">
                <td class="px-6 py-3 capitalize">{{ $pub->tipo }}</td>
                <td class="px-6 py-3 font-medium text-slate-800">{{ $pub->titulo }}</td>
                <td class="px-6 py-3 text-slate-500">{{ $pub->fecha_publicacion->format('d/m/Y') }}</td>
                <td class="px-6 py-3">
                    @if($pub->publicado)
                        <span class="text-green-700 bg-green-50 px-2.5 py-1 rounded-full text-xs font-medium">Publicado</span>
                    @else
                        <span class="text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full text-xs font-medium">Oculto</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right">
                    <div class="inline-flex items-center gap-4">
                        <a href="{{ route('admin.publicaciones.edit', $pub->id) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Editar</a>
                        <form method="POST" action="{{ route('admin.publicaciones.destroy', $pub->id) }}"
                              onsubmit="return confirm('¿Eliminar esta publicación?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-slate-400">Aún no hay publicaciones creadas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection