@extends('layouts.admin')

@section('title', 'Docentes')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-600 text-sm">Perfiles de docentes que aparecen en la vitrina pública.</p>
    <a href="{{ route('admin.docentes.create') }}"
       class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-5 py-2.5 rounded-lg transition text-sm">
        + Nuevo docente
    </a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @forelse($docentes as $docente)
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center">
            @if($docente->foto)
                <img src="{{ asset('storage/' . $docente->foto) }}" class="w-full h-full object-cover">
            @else
                <span class="text-2xl text-slate-400">👤</span>
            @endif
        </div>
        <h3 class="font-semibold text-slate-800">{{ $docente->nombres }}</h3>
        <p class="text-xs text-slate-500 mb-4">{{ $docente->cargo }}</p>
       <div class="flex justify-center gap-4">
            <a href="{{ route('admin.docentes.edit', $docente->id) }}" class="text-blue-700 hover:text-blue-900 text-xs font-medium">Editar</a>
            <form method="POST" action="{{ route('admin.docentes.destroy', $docente->id) }}"
                  onsubmit="return confirm('¿Eliminar este docente?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
            </form>
        </div>
    </div>
    @empty
    <p class="text-slate-400 col-span-3 text-center py-8">Aún no hay docentes registrados.</p>
    @endforelse
</div>

@endsection