@extends('layouts.public')

@section('title', 'Galería')

@section('content')
<section class="bg-blue-950 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="uppercase tracking-widest text-blue-300 text-sm font-semibold mb-3">Galería</p>
        <h1 class="text-2xl md:text-3xl font-bold">Momentos de nuestra comunidad</h1>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-16">
    @if($imagenes->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 p-10 text-center text-slate-500">
            Próximamente subiremos fotos para mostrar la vida del colegio.
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($imagenes as $imagen)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $imagen->imagen) }}" alt="{{ $imagen->descripcion ?? 'Imagen de la galería' }}" loading="lazy" class="w-full h-56 object-cover">
                    @if($imagen->descripcion)
                        <div class="p-4">
                            <p class="text-sm text-slate-600">{{ $imagen->descripcion }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
