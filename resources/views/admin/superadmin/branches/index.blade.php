@extends('admin.superadmin.layout')
 
@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.index') }}" class="text-sm font-bold text-gray-400 hover:text-dark transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Menú Maestro
    </a>
</div>
 
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-4xl font-display text-textMain tracking-tight uppercase">Sedes / Sucursales</h2>
        <p class="text-gray-500 font-medium italic">Administra los puntos de despacho físicos.</p>
    </div>
    <a href="{{ route('superadmin.branches.create') }}" class="bg-dark hover:bg-teal-700 text-white font-extra-bold py-3 px-8 rounded-2xl shadow-lg shadow-dark/20 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
        <i class="fas fa-plus"></i> Nueva Sede
    </a>
</div>
 
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($branches as $branch)
    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-100 flex flex-col transition hover:shadow-2xl hover:-translate-y-1">
        <div class="flex justify-between items-start mb-6">
            <div class="h-14 w-14 rounded-2xl bg-dark/10 flex items-center justify-center text-dark text-xl">
                <i class="fas fa-store"></i>
            </div>
            @if($branch->is_active)
                <span class="bg-green-100 text-green-600 text-[10px] font-extra-bold uppercase tracking-widest px-3 py-1 rounded-full">Activa</span>
            @else
                <span class="bg-red-100 text-red-600 text-[10px] font-extra-bold uppercase tracking-widest px-3 py-1 rounded-full">Inactiva</span>
            @endif
        </div>
 
        <h3 class="text-2xl font-display text-textMain mb-2">{{ $branch->name }}</h3>
        <p class="text-gray-500 text-sm mb-4 line-clamp-2"><i class="fas fa-map-marker-alt mr-2 text-dark/30"></i>{{ $branch->address }}</p>
        <div class="text-sm font-bold text-textMain/70 mb-6 bg-gray-50 p-4 rounded-2xl border border-gray-100">
            <div class="flex items-center gap-3 mb-2">
                <i class="fab fa-whatsapp text-green-500"></i>
                <span>+{{ $branch->whatsapp ?? 'Sin definir' }}</span>
            </div>
            <div class="flex items-center gap-3 text-xs text-gray-400 font-mono">
                <i class="fas fa-location-arrow"></i>
                <span>{{ $branch->lat }}, {{ $branch->lng }}</span>
            </div>
        </div>
 
        <div class="mt-auto flex gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('superadmin.branches.edit', $branch) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-textMain font-bold py-3 rounded-xl transition text-center text-sm">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <form action="{{ route('superadmin.branches.destroy', $branch) }}" method="POST" class="flex-none" onsubmit="return confirm('¿Eliminar esta sede?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-accent/10 border border-accent/20 text-accent hover:bg-accent hover:text-white px-4 py-3 rounded-xl transition">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-[2.5rem] p-20 text-center border-2 border-dashed border-gray-100">
        <div class="text-gray-300 text-6xl mb-6">
            <i class="fas fa-store-slash"></i>
        </div>
        <h4 class="text-2xl font-display text-textMain mb-2 uppercase">No hay sedes registradas</h4>
        <p class="text-gray-400 mb-8">Debes agregar al menos una sede para que el sistema funcione.</p>
        <a href="{{ route('superadmin.branches.create') }}" class="inline-flex bg-dark hover:bg-teal-700 text-white font-extra-bold py-3 px-8 rounded-2xl shadow-lg shadow-dark/20 transition">
            Añadir mi primera sede
        </a>
    </div>
    @endforelse
</div>
@endsection
