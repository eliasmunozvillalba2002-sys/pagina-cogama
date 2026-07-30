@extends('layouts.admin')

@section('title', 'Editar docente')

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

<form method="POST" action="{{ route('admin.docentes.update', $docente->id) }}" enctype="multipart/form-data"
      class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6 max-w-2xl">
    @csrf
    @method('PUT')

    @if($docente->foto)
        <img src="{{ asset('storage/' . $docente->foto) }}" class="w-20 h-20 rounded-full object-cover">
    @endif

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Nombres completos</label>
        <input type="text" name="nombres" value="{{ old('nombres', $docente->nombres) }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Cargo</label>
        <input type="text" name="cargo" value="{{ old('cargo', $docente->cargo) }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Biografía breve (opcional)</label>
        <textarea name="bio" rows="3"
                  class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('bio', $docente->bio) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Cambiar foto (opcional)</label>
        <input type="file" name="foto" accept="image/*"
               class="w-full border border-slate-300 rounded-lg px-4 py-2.5">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Orden de aparición</label>
        <input type="number" name="orden" value="{{ old('orden', $docente->orden) }}"
               class="w-32 border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-6 py-3 rounded-lg transition">
            Guardar cambios
        </button>
        <a href="{{ route('admin.docentes.index') }}" class="text-slate-500 px-6 py-3 hover:text-slate-700">
            Cancelar
        </a>
    </div>
</form>

@endsection