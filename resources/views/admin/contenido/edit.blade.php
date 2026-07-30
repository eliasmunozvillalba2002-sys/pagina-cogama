@extends('layouts.admin')

@section('title', 'Contenido del colegio')

@section('content')

@if(session('status'))
    <div class="bg-green-50 text-green-700 text-sm rounded-lg px-4 py-3 mb-6">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.contenido.update') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6 max-w-3xl">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del colegio</label>
        <input type="text" name="nombre_colegio" value="{{ old('nombre_colegio', $contenido['nombre_colegio'] ?? '') }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Lema</label>
        <input type="text" name="lema" value="{{ old('lema', $contenido['lema'] ?? '') }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Mensaje de bienvenida (portada)</label>
        <textarea name="bienvenida" rows="2"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('bienvenida', $contenido['bienvenida'] ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Misión</label>
        <textarea name="mision" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('mision', $contenido['mision'] ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Visión</label>
        <textarea name="vision" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('vision', $contenido['vision'] ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Filosofía</label>
        <textarea name="filosofia" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('filosofia', $contenido['filosofia'] ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Política de Calidad</label>
        <textarea name="politica_calidad" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('politica_calidad', $contenido['politica_calidad'] ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Perfil del Estudiante</label>
        <textarea name="perfil_estudiante" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('perfil_estudiante', $contenido['perfil_estudiante'] ?? '') }}</textarea>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Bandera del colegio</label>
            <input type="file" name="bandera_imagen" accept="image/*"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            @if(!empty($contenido['bandera_imagen']))
                <p class="text-xs text-slate-500 mt-2">Archivo actual: {{ basename($contenido['bandera_imagen']) }}</p>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Escudo del colegio</label>
            <input type="file" name="escudo_imagen" accept="image/*"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            @if(!empty($contenido['escudo_imagen']))
                <p class="text-xs text-slate-500 mt-2">Archivo actual: {{ basename($contenido['escudo_imagen']) }}</p>
            @endif
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Imagen de portada (inicio)</label>
        <input type="file" name="imagen_portada" accept="image/*"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <p class="text-xs text-slate-500 mt-2">Recomendación: usa una imagen horizontal de al menos 1600×900 px para que se vea nítida y no se vea pixelada o «mocha».</p>
        @if(!empty($contenido['imagen_portada']))
            <div class="mt-3 flex items-center gap-3">
                <p class="text-xs text-slate-500">Archivo actual: {{ basename($contenido['imagen_portada']) }}</p>
                <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="eliminar_imagen_portada" value="1">
                    Eliminar imagen actual
                </label>
            </div>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Himno institucional</label>
        <textarea name="himno_texto" rows="4"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('himno_texto', $contenido['himno_texto'] ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Parte legal y resoluciones</label>
        <textarea name="parte_legal" rows="4"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('parte_legal', $contenido['parte_legal'] ?? '') }}</textarea>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Correo de contacto</label>
            <input type="email" name="correo_contacto" value="{{ old('correo_contacto', $contenido['correo_contacto'] ?? '') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $contenido['telefono'] ?? '') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">WhatsApp</label>
            <input type="text" name="whatsapp" value="{{ old('whatsapp', $contenido['whatsapp'] ?? '') }}"
                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Horario de secretaría</label>
            <textarea name="horario_secretaria" rows="3"
                      class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('horario_secretaria', $contenido['horario_secretaria'] ?? '') }}</textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Dirección</label>
        <input type="text" name="direccion" value="{{ old('direccion', $contenido['direccion'] ?? '') }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <button type="submit"
            class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-6 py-3 rounded-lg transition">
        Guardar cambios
    </button>
</form>

@endsection