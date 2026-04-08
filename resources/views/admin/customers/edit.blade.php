@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('customers.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver a Clientes
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-display text-textMain tracking-tight mb-2">Editar Cliente</h2>
        <p class="text-gray-500 font-medium italic">Actualiza la información de {{ $customer->first_name }}.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] p-10 sm:p-14 shadow-2xl shadow-gray-200/50 border border-gray-100">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Nombre</label>
                    <input type="text" name="first_name" value="{{ $customer->first_name }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                </div>
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Apellido</label>
                    <input type="text" name="last_name" value="{{ $customer->last_name }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                </div>
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Cédula</label>
                    <input type="text" name="cedula" value="{{ $customer->cedula }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                </div>
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Teléfono</label>
                    <input type="tel" name="phone" value="{{ $customer->phone }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                </div>
            </div>

            <div>
                <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Ubicación (Opcional)</label>
                <textarea name="location" rows="3" class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold">{{ $customer->location }}</textarea>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-green-700 text-white font-extra-bold py-5 rounded-3xl shadow-xl shadow-bg-primary/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg mt-10">
                <i class="fas fa-save text-xl"></i> Guardar Cambios
            </button>
        </form>
    </div>
</div>
@endsection
