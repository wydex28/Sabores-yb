@extends('admin.superadmin.layout')
 
@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.branches.index') }}" class="text-sm font-bold text-gray-400 hover:text-dark transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver a Sedes
    </a>
</div>
 
<div class="max-w-3xl mx-auto">
    <div class="mb-10 text-center">
        <div class="inline-flex h-16 w-16 rounded-2xl bg-dark/10 items-center justify-center text-dark mb-4 shadow-lg shadow-dark/20">
            <i class="fas fa-store text-2xl"></i>
        </div>
        <h2 class="text-4xl font-display text-textMain tracking-tight mb-2 uppercase">Nueva Sede</h2>
        <p class="text-gray-500 font-medium italic">Registra un nuevo punto de despacho.</p>
    </div>
 
    <div class="bg-white rounded-[2.5rem] p-10 sm:p-14 shadow-2xl shadow-gray-200/50 border border-gray-100">
        <form action="{{ route('superadmin.branches.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-dark text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Nombre de la Sede</label>
                    <input type="text" name="name" placeholder="Ej. Bello Monte" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                </div>
                
                <div>
                    <label class="block text-dark text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Dirección Física</label>
                    <input type="text" name="address" placeholder="Calle..., Edificio..., Referencia..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                </div>
 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-dark text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Latitud (Coordenadas)</label>
                        <input type="text" name="lat" placeholder="Ej. 10.456789" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-dark text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Longitud (Coordenadas)</label>
                        <input type="text" name="lng" placeholder="Ej. -67.345678" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[10px] text-gray-400 italic px-2">
                            <i class="fas fa-info-circle mr-1"></i> Tip: Puedes obtener las coordenadas haciendo clic derecho en cualquier punto de Google Maps.
                        </p>
                    </div>
                </div>
 
                <div>
                    <label class="block text-dark text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">WhatsApp de la Sede (Sin @ ni +)</label>
                    <input type="text" name="whatsapp" placeholder="58412..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                </div>
 
                <div class="flex items-center gap-4 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <div class="flex-grow">
                        <label class="block text-textMain font-bold">Estado de la Sede</label>
                        <p class="text-xs text-gray-500">¿Esta sede está operativa para recibir pedidos?</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" class="sr-only peer" checked>
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-dark"></div>
                    </label>
                </div>
            </div>
 
            <button type="submit" class="w-full bg-dark hover:bg-teal-700 text-white font-extra-bold py-5 rounded-3xl shadow-xl shadow-teal-500/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg mt-10 uppercase tracking-widest">
                <i class="fas fa-save text-xl"></i> Crear Sede
            </button>
        </form>
    </div>
</div>
@endsection
