@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-10">
        <h2 class="text-4xl font-display text-textMain tracking-tight">Editar Producto</h2>
        <p class="text-gray-500 font-medium">Modifica los detalles de <span class="text-primary font-bold">"{{ $product->title }}"</span>.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="p-8 sm:p-12">
            <form method="POST" action="{{ route('admin.update', $product) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1">Nombre del Producto</label>
                        <input type="text" name="title" value="{{ $product->title }}" placeholder="Ej. Empanada de Mechada" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1">Descripción corta</label>
                        <textarea name="description" placeholder="Ingredientes o detalles especiales..." rows="3" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">{{ $product->description }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1">Precio (Ref. USD)</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-gray-400">$</span>
                            <input type="number" step="0.01" name="price" value="{{ $product->price }}" placeholder="1.50" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-12 pr-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1">Categoría</label>
                        <select name="category" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition appearance-none" required>
                            <option value="Empanadas Fritas" {{ $product->category == 'Empanadas Fritas' ? 'selected' : '' }}>Empanadas Fritas</option>
                            <option value="Empanadas Especiales" {{ $product->category == 'Empanadas Especiales' ? 'selected' : '' }}>Empanadas Especiales</option>
                            <option value="Bebidas" {{ $product->category == 'Bebidas' ? 'selected' : '' }}>Bebidas</option>
                            <option value="Otros" {{ $product->category == 'Otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1 text-primary">Imagen actual</label>
                        <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 mb-4">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="h-20 w-20 rounded-xl object-cover shadow-sm">
                            @else
                                <div class="h-20 w-20 bg-white rounded-xl flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                            <div class="text-sm font-medium text-gray-400 italic">Si subes una nueva imagen, la anterior se reemplazará automáticamente.</div>
                        </div>

                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-widest mb-3 ml-1">Subir nueva imagen (opcional)</label>
                        <div class="relative group">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                            <div class="w-full bg-white border-2 border-dashed border-gray-200 rounded-2xl py-8 px-6 text-center group-hover:border-primary/50 transition group-hover:bg-primary/5">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2 group-hover:text-primary transition"></i>
                                <p class="text-sm text-gray-400 font-bold group-hover:text-primary transition">Actualizar foto del producto</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('admin.index') }}" class="text-gray-400 font-bold hover:text-textMain transition order-2 sm:order-1">Cancelar edición</a>
                    <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-green-600 text-white font-bold py-4 px-12 rounded-2xl shadow-lg shadow-primary/20 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 order-1 sm:order-2">
                        <i class="fas fa-sync-alt"></i> Actualizar producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
