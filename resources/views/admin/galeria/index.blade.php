@extends('layouts.admin')

@section('title', 'Galería')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-600 text-sm">Gestiona las imágenes que aparecen en la galería pública.</p>
    <a href="{{ route('admin.galeria.create') }}"
       class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-5 py-2.5 rounded-lg transition text-sm">
        + Nueva imagen
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-left">
            <tr>
                <th class="px-6 py-3">Vista previa</th>
                <th class="px-6 py-3">Descripción</th>
                <th class="px-6 py-3">Orden</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($imagenes as $imagen)
            <tr class="border-t border-slate-100">
                <td class="px-6 py-3">
                    <img src="{{ asset('storage/' . $imagen->imagen) }}" alt="{{ $imagen->descripcion ?? 'Imagen de galería' }}" class="w-24 h-16 object-cover rounded-lg">
                </td>
                <td class="px-6 py-3 text-slate-700">{{ $imagen->descripcion ?? 'Sin descripción' }}</td>
                <td class="px-6 py-3 text-slate-500">{{ $imagen->orden }}</td>
                <td class="px-6 py-3 text-right">
                    <form method="POST" action="{{ route('admin.galeria.destroy', $imagen->id) }}" onsubmit="return confirm('¿Eliminar esta imagen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-slate-400">Aún no hay imágenes en la galería.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection