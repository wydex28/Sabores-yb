@extends('admin.superadmin.layout')

@section('content')
<div class="mb-4 text-center">
    <a href="{{ route('superadmin.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center justify-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Menú Maestro
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Generador de Módulos -->
    <div class="lg:col-span-5 space-y-8">
        <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <h3 class="text-3xl font-display text-primary mb-8 flex items-center gap-4">
                <i class="fas fa-magic"></i> Constructor
            </h3>
            <form action="{{ route('superadmin.createModule') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-primary text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Nombre (Estilo Model)</label>
                        <input type="text" name="name" placeholder="Ej: Proveedor" class="w-full bg-gray-50 border border-gray-50 rounded-2xl py-4 px-6 font-bold text-sm" required>
                    </div>
                    <div>
                        <label class="block text-primary text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Icono (FontAwesome)</label>
                        <input type="text" name="icon" placeholder="Ej: fas fa-truck" class="w-full bg-gray-50 border border-gray-50 rounded-2xl py-4 px-6 font-bold text-sm" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-primary text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Identidad Visual (Color)</label>
                    <input type="color" name="color" value="#00A859" class="h-16 w-full rounded-2xl cursor-pointer shadow-sm">
                </div>

                <div>
                    <label class="block text-primary text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Campos (Estructura JSON)</label>
                    <textarea name="fields" rows="4" class="w-full bg-gray-50 border border-gray-50 rounded-2xl py-4 px-6 font-mono text-xs" required>[{"name": "nombre", "type": "string"}, {"name": "valor", "type": "decimal"}]</textarea>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-3 ml-1">
                        <label class="block text-primary text-[10px] font-extra-bold uppercase tracking-widest ">Relaciones y Visualización</label>
                        <span class="text-[9px] bg-secondary/10 text-secondary px-2 py-1 rounded font-bold uppercase tracking-widest">Avanzado</span>
                    </div>
                    <textarea name="relations" rows="3" class="w-full bg-gray-50 border border-gray-50 rounded-2xl py-4 px-6 font-mono text-xs" placeholder='[{"model": "Category", "type": "belongsTo", "display_column": "name"}]'></textarea>
                    <p class="text-[9px] text-gray-400 mt-3 italic leading-relaxed">
                        <i class="fas fa-info-circle mr-1"></i> Usa <span class="font-bold text-dark">"display_column"</span> para elegir qué campo se verá en el Selector Dinámico del nuevo módulo.
                    </p>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-green-700 text-white font-extra-bold py-5 rounded-3xl shadow-xl shadow-bg-primary/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg mt-10 uppercase">
                    <i class="fas fa-hammer text-xl"></i> Crear Módulo
                </button>
            </form>
        </div>
    </div>

    <!-- Módulos Instalados -->
    <div class="lg:col-span-7 space-y-8">
        <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <h3 class="text-3xl font-display text-textMain mb-8 flex items-center gap-4">
                <i class="fas fa-layer-group text-dark"></i> Instalados
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($modules as $module)
                    <div class="flex flex-col gap-4 p-6 bg-gray-50 rounded-3xl border border-gray-100 transition-all hover:bg-white hover:shadow-xl hover:shadow-gray-200/30 group">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-gray-200/50 group-hover:scale-110 transition" style="background-color: {{ $module->color }}">
                                <i class="{{ $module->icon }} text-2xl"></i>
                            </div>
                            <div>
                                <div class="font-display text-xl text-textMain tracking-wide group-hover:text-primary transition">{{ $module->name }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Activo</div>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200/50 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-gray-300">{{ $module->created_at->format('d/m/Y') }}</span>
                            <a href="{{ route('admin.modules.index', $module->name) }}" class="text-xs font-extra-bold text-primary hover:underline flex items-center gap-1">
                                VER CRUD <i class="fas fa-chevron-right text-[8px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-20 bg-gray-50 rounded-[2.5rem] border border-dashed border-gray-200">
                        <div class="text-gray-300 font-display text-2xl uppercase tracking-widest">Zona Vacía</div>
                        <p class="text-gray-400 text-xs font-medium italic mt-2">No has construido extensiones todavía.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
