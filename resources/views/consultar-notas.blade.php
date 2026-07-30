@extends('layouts.public')

@section('title', 'Consultar notas')

@section('content')

<section class="max-w-2xl mx-auto px-6 py-16">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-slate-800 mb-3">Consulta tus notas</h1>
        <p class="text-slate-600">
            Escribe tu número de documento para ver tus calificaciones por periodo.
        </p>
    </div>

    {{-- FORMULARIO --}}
    <form method="POST" action="{{ route('notas.buscar') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row gap-3 mb-10">
        @csrf
        <input type="text" name="documento" placeholder="Número de documento"
               value="{{ old('documento') }}"
               class="flex-grow border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <button type="submit"
                class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-6 py-3 rounded-lg transition">
            Buscar
        </button>
    </form>

    @error('documento')
        <div class="bg-red-50 text-red-700 text-sm rounded-lg px-4 py-3 mb-8 text-center">
            {{ $message }}
        </div>
    @enderror

    {{-- RESULTADOS --}}
    @isset($estudiante)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-1">
                {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
            </h2>
            <p class="text-sm text-slate-500 mb-6">
                Documento: {{ $estudiante->documento }}
                @if($estudiante->ciclo) · {{ $estudiante->ciclo->nombre }} @endif
            </p>

            @if($notas->isEmpty())
                <p class="text-slate-500 text-sm">Aún no hay notas registradas para este estudiante.</p>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-slate-500 border-b border-slate-200">
                            <th class="py-2">Periodo</th>
                            <th class="py-2">Asignatura</th>
                            <th class="py-2 text-right">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notas as $nota)
                        <tr class="border-b border-slate-100">
                            <td class="py-2">{{ $nota->periodo }}</td>
                            <td class="py-2">{{ $nota->asignatura->nombre }}</td>
                            <td class="py-2 text-right font-semibold">{{ $nota->nota }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endisset

</section>

@endsection