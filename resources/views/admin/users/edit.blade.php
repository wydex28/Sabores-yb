@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
            <i class="fas fa-arrow-left text-xs"></i> Volver a Clientes
        </a>
    </div>

    <div class="mb-10">
        <h2 class="text-4xl font-display text-textMain tracking-tight">Editar Cliente</h2>
        <p class="text-gray-500 font-medium">Actualiza los datos del cliente.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-300/40 border border-gray-100 overflow-hidden">
        <div class="p-8 sm:p-12">
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Nombre</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Apellido</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Cédula</label>
                        <input type="text" name="cedula" value="{{ $user->cedula }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Celular</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-primary text-xs font-bold uppercase tracking-widest mb-3 ml-1">Contraseña (Opcional)</label>
                        <input type="password" name="password" placeholder="Solo llena si deseas cambiarla..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-textMain font-bold focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('users.index') }}" class="text-gray-400 font-bold hover:text-textMain transition order-2 sm:order-1">Cancelar</a>
                    <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-green-600 text-white font-bold py-4 px-12 rounded-2xl shadow-lg shadow-primary/20 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 order-1 sm:order-2">
                        <i class="fas fa-sync-alt"></i> Actualizar cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
