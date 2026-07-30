@extends('layouts.public')

@section('title', 'Inscripción')

@section('content')

<section class="max-w-2xl mx-auto px-6 py-16">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-slate-800 mb-3">Inscríbete</h1>
        <p class="text-slate-600">
            Completa tus datos y nos comunicaremos contigo para continuar el proceso.
        </p>
    </div>

    @if(session('status'))
        <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6 text-center">
            {{ session('status') }}
        </div>
    @endif

    @if($habilitado !== '1' && $habilitado !== 1)

        <div class="bg-yellow-50 text-yellow-800 text-sm rounded-lg px-4 py-4 text-center">
            Las inscripciones están cerradas por el momento. Vuelve a intentarlo más adelante o contáctanos directamente.
        </div>

    @else

    @if($errors->any())
        <div class="bg-red-50 text-red-700 text-sm rounded-lg px-4 py-3 mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('inscripcion.store') }}"
          class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-5">
        @csrf

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label for="nombres" class="block text-sm font-medium text-slate-700 mb-1">Nombres</label>
                <input id="nombres" type="text" name="nombres" value="{{ old('nombres') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <label for="apellidos" class="block text-sm font-medium text-slate-700 mb-1">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" value="{{ old('apellidos') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
        </div>

        <div>
            <label for="documento" class="block text-sm font-medium text-slate-700 mb-1">Número de documento</label>
            <input id="documento" type="text" name="documento" value="{{ old('documento') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label for="telefono" class="block text-sm font-medium text-slate-700 mb-1">Teléfono / WhatsApp</label>
                <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo (opcional)</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
        </div>

        <div>
            <label for="ciclo_interes" class="block text-sm font-medium text-slate-700 mb-1">Ciclo de interés (opcional)</label>
            <select id="ciclo_interes" name="ciclo_interes"
                    class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="">No estoy seguro</option>
                <option value="CLEI 3" {{ old('ciclo_interes') == 'CLEI 3' ? 'selected' : '' }}>CLEI 3 (6° y 7°)</option>
                <option value="CLEI 4" {{ old('ciclo_interes') == 'CLEI 4' ? 'selected' : '' }}>CLEI 4 (8° y 9°)</option>
                <option value="CLEI 5" {{ old('ciclo_interes') == 'CLEI 5' ? 'selected' : '' }}>CLEI 5 (10°)</option>
                <option value="CLEI 6" {{ old('ciclo_interes') == 'CLEI 6' ? 'selected' : '' }}>CLEI 6 (11°)</option>
            </select>
        </div>

        <div>
            <label for="mensaje" class="block text-sm font-medium text-slate-700 mb-1">Mensaje (opcional)</label>
            <textarea id="mensaje" name="mensaje" rows="3"
                      class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('mensaje') }}</textarea>
        </div>

        <button type="submit"
                class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold px-6 py-3.5 rounded-lg transition">
            Enviar inscripción
        </button>
    </form>

    @endif

</section>

@endsection