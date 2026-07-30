@extends('layouts.public')

@section('title', 'Nuestro Equipo')
@section('meta_description', 'Conoce al equipo docente del Colegio Gabriel García Márquez y el acompañamiento que ofrece para el programa CLEI y la educación dominical.')

@section('content')

<section class="bg-blue-950 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="uppercase tracking-widest text-blue-300 text-sm font-semibold mb-3">Nuestro Equipo</p>
        <h1 class="text-2xl md:text-3xl font-bold">Las personas detrás de tu bachillerato</h1>
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 py-16">
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($docentes as $docente)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center">
                @if($docente->foto)
                    <img src="{{ asset('storage/' . $docente->foto) }}" alt="{{ $docente->nombres ?? 'Docente' }}" loading="lazy" class="w-full h-full object-cover">
                @else
                    <span class="text-3xl text-slate-400">👤</span>
                @endif
            </div>
            <h3 class="font-semibold text-slate-800">{{ $docente->nombres }}</h3>
            <p class="text-sm text-blue-700 mb-2">{{ $docente->cargo }}</p>
            @if($docente->bio)
                <p class="text-xs text-slate-500">{{ $docente->bio }}</p>
            @endif
        </div>
        @empty
        <p class="text-slate-400 col-span-3 text-center py-8">Próximamente presentaremos a nuestro equipo.</p>
        @endforelse
    </div>
</section>

@endsection