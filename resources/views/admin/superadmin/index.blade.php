@extends('admin.superadmin.layout')

@section('content')
<div class="mb-10 text-center">
    <h2 class="text-4xl font-display text-textMain tracking-tight">Menú Maestro</h2>
    <p class="text-gray-500 font-medium italic">{{ $appName }} - Configuración de Infraestructura</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <!-- Configuración Marca -->
    <a href="{{ route('superadmin.settings.brand') }}" class="group bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 hover:border-dark/30 transition transform hover:-translate-y-2 flex flex-col items-center text-center">
        <div class="w-24 h-24 bg-dark/10 rounded-3xl flex items-center justify-center text-dark mb-6 group-hover:bg-dark group-hover:text-white transition shadow-sm">
            <i class="fas fa-palette text-4xl"></i>
        </div>
        <h3 class="text-2xl font-display text-textMain tracking-wide mb-2 uppercase text-xs sm:text-base">Identidad de Marca</h3>
        <p class="text-xs text-gray-400 font-medium line-clamp-2">Logos, colores corporativos y temas visuales.</p>
    </a>

    <!-- Sedes / Sucursales -->
    <a href="{{ route('superadmin.branches.index') }}" class="group bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 hover:border-secondary/30 transition transform hover:-translate-y-2 flex flex-col items-center text-center">
        <div class="w-24 h-24 bg-secondary/10 rounded-3xl flex items-center justify-center text-secondary mb-6 group-hover:bg-secondary group-hover:text-white transition shadow-sm">
            <i class="fas fa-store text-4xl"></i>
        </div>
        <h3 class="text-2xl font-display text-secondary tracking-wide mb-2 uppercase text-xs sm:text-base">Gestión de Sedes</h3>
        <p class="text-xs text-gray-400 font-medium line-clamp-2">Administra múltiples ubicaciones físicas y contacto.</p>
    </a>

    <!-- Gestor de Módulos -->
    <a href="{{ route('superadmin.settings.modules') }}" class="group bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 hover:border-primary/30 transition transform hover:-translate-y-2 flex flex-col items-center text-center">
        <div class="w-24 h-24 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition shadow-sm">
            <i class="fas fa-cubes text-4xl"></i>
        </div>
        <h3 class="text-2xl font-display text-textMain tracking-wide mb-2 uppercase text-xs sm:text-base">Gestor de Módulos</h3>
        <p class="text-xs text-gray-400 font-medium line-clamp-2">Crea tablas, relaciones y despliega nuevas funciones.</p>
    </a>

    <!-- Base de Datos (Mantenimiento) -->
    <div class="md:col-span-3 bg-white p-8 rounded-3xl border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6 mt-4">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary text-xl font-bold">
                <i class="fas fa-database"></i>
            </div>
            <div>
                <h4 class="font-bold text-textMain">Herramientas de BD</h4>
                <p class="text-xs text-gray-400">Ejecuta migraciones o seeders con respaldo automático.</p>
            </div>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('superadmin.runMigrations') }}" method="POST">
                @csrf
                <button type="submit" class="bg-dark/10 text-dark hover:bg-dark hover:text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
                    EJECUTAR MIGRACIONES
                </button>
            </form>
            <form action="{{ route('superadmin.runSeeders') }}" method="POST">
                @csrf
                <button type="submit" class="bg-secondary/10 text-secondary hover:bg-secondary hover:text-white px-4 py-2.5 rounded-xl font-bold text-xs transition">
                    EJECUTAR SEEDERS
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
