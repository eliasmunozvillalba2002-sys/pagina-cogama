@extends('layouts.admin')

@section('title', 'Nueva publicación')

@section('content')

@if($errors->any())
    <div class="bg-red-50 text-red-700 text-sm rounded-lg px-4 py-3 mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.publicaciones.store') }}" enctype="multipart/form-data"
      class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6 max-w-2xl">
    @csrf

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
        <select name="tipo" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
            <option value="noticia">Noticia</option>
            <option value="circular">Circular</option>
            <option value="promocion">Promoción</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Contenido</label>
        <textarea name="contenido" rows="5"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('contenido') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Imagen o PDF (opcional)</label>
        <input type="file" name="imagen" accept="image/*,.pdf"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5">
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="publicado" value="1" checked id="publicado" class="rounded border-slate-300">
        <label for="publicado" class="text-sm text-slate-700">Publicar inmediatamente en la portada</label>
    </div>

    <div class="flex gap-3">
        <button type="submit"
                class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-6 py-3 rounded-lg transition">
            Guardar
        </button>
        <a href="{{ route('admin.publicaciones.index') }}"
           class="text-slate-500 px-6 py-3 hover:text-slate-700">
            Cancelar
        </a>
    </div>
</form>

@endsection