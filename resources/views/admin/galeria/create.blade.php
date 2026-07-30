@extends('layouts.admin')

@section('title', 'Nueva imagen')

@section('content')

<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.galeria.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-5">
        @csrf

        <div>
            <label for="imagen" class="block text-sm font-medium text-slate-700 mb-1">Imagen</label>
            <input id="imagen" type="file" name="imagen" accept="image/*" class="w-full border border-slate-300 rounded-lg px-4 py-2.5" required>
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-slate-700 mb-1">Descripción (opcional)</label>
            <textarea id="descripcion" name="descripcion" rows="3" class="w-full border border-slate-300 rounded-lg px-4 py-2.5"></textarea>
        </div>

        <div>
            <label for="orden" class="block text-sm font-medium text-slate-700 mb-1">Orden</label>
            <input id="orden" type="number" name="orden" value="0" class="w-full border border-slate-300 rounded-lg px-4 py-2.5">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-6 py-3 rounded-lg transition">Guardar imagen</button>
            <a href="{{ route('admin.galeria.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-6 py-3 rounded-lg transition">Cancelar</a>
        </div>
    </form>
</div>

@endsection