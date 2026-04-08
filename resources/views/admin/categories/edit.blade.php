@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('categories.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
            <i class="fas fa-arrow-left text-xs"></i> Volver a Categorías
        </a>
    </div>

    <div class="mb-10">
        <h2 class="text-4xl font-display text-textMain tracking-tight">Editar Categoría</h2>
        <p class="text-gray-500 font-medium">Actualiza el nombre de la categoría.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-300/40 border border-gray-100 overflow-hidden">
        <div class="p-8 sm:p-12">
            <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Nombre de la Categoría</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Icono (FontAwesome)</label>
                        <input type="text" name="icon" value="{{ $category->icon }}" placeholder="Ej. fas fa-pizza-slice" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Orden de Visualización</label>
                        <input type="number" name="sort_order" value="{{ $category->sort_order }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div class="flex items-center gap-4 pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" class="sr-only peer" {{ $category->is_active ? 'checked' : '' }}>
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ms-3 text-xs font-bold text-gray-400 uppercase tracking-widest">¿Categoría Activa?</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Color Distintivo</label>
                    <div class="flex items-center gap-4">
                        <input type="color" name="color" value="{{ $category->color ?: '#00A859' }}" class="h-14 w-14 rounded-2xl cursor-pointer shadow-sm border border-gray-100">
                        <p class="text-xs text-gray-400 font-medium">Este color se usará en el menú digital.</p>
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('categories.index') }}" class="text-gray-400 font-bold hover:text-textMain transition order-2 sm:order-1">Cancelar</a>
                    <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-green-600 text-white font-bold py-4 px-12 rounded-2xl shadow-lg shadow-primary/20 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 order-1 sm:order-2">
                        <i class="fas fa-sync-alt"></i> Actualizar categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
