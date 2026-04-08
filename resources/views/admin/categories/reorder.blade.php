@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver a Gestión
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-display text-textMain tracking-tight">Organizar Menú</h2>
        <p class="text-gray-500 font-medium">Define el orden en que aparecerán las categorías en la landing page.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-300/40 border border-gray-100 overflow-hidden">
        <form action="{{ route('categories.updateOrder') }}" method="POST" class="p-8 sm:p-12">
            @csrf
            <div class="space-y-4 mb-10">
                @foreach($categories as $category)
                <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-primary/30 transition-all group">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-primary group-hover:text-white transition">
                        <i class="{{ $category->icon ?: 'fas fa-layer-group' }} text-lg"></i>
                    </div>
                    <div class="flex-grow">
                        <span class="font-bold text-textMain block">{{ $category->name }}</span>
                        <span class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Estado: {{ $category->is_active ? 'Activa' : 'Inactiva' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="text-[10px] font-bold text-gray-300 uppercase">Posición:</label>
                        <input type="number" name="orders[{{ $category->id }}]" value="{{ $category->sort_order }}" class="w-20 bg-white border border-gray-200 rounded-xl py-2 px-3 text-center font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none transition shadow-sm">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-primary hover:bg-green-600 text-white font-bold py-4 px-12 rounded-2xl shadow-lg shadow-primary/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fas fa-save"></i> Guardar nuevo orden
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
