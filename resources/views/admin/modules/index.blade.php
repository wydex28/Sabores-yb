@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Panel
    </a>
</div>

<div class="mb-10 flex flex-col md:flex-row md:justify-between items-center text-center md:text-left gap-6">
    <div>
        <div class="flex items-center justify-center md:justify-start gap-4 mb-2">
            <div class="h-10 w-10 rounded-xl flex items-center justify-center text-white" style="background-color: {{ $module->color }}">
                <i class="{{ $module->icon }}"></i>
            </div>
            <h2 class="text-4xl font-display text-textMain tracking-tight">Gestión de {{ $module->name }}</h2>
        </div>
        <p class="text-gray-500 font-medium italic">Administración dinámica del módulo.</p>
    </div>
    <a href="{{ route('admin.modules.create', $module->name) }}" class="bg-dark hover:bg-teal-600 text-white font-bold py-3 px-8 rounded-2xl shadow-lg shadow-dark/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
        <i class="fas fa-plus"></i> Añadir Registro
    </a>
</div>

<div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-dark/10 border-b border-dark/10">
                <tr>
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">ID</th>
                    @foreach($module->fields as $field)
                    <th class="px-8 py-5 text-left text-xs font-bold text-textMain uppercase tracking-widest">{{ \Illuminate\Support\Str::title($field['name']) }}</th>
                    @endforeach
                    <th class="px-8 py-5 text-right text-xs font-bold text-textMain uppercase tracking-widest">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr class="hover:bg-dark/5 transition-colors duration-200">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-base font-bold text-gray-400">#{{ $row->id }}</div>
                    </td>
                    @foreach($module->fields as $field)
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="text-sm font-bold text-textMain">{{ $row->{$field['name']} }}</div>
                    </td>
                    @endforeach
                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('admin.modules.destroy', [$module->name, $row->id]) }}" method="POST" class="inline-block" 
                                onsubmit="event.preventDefault(); Swal.fire({
                                    title: '¿Eliminar Registro?',
                                    text: 'Esta acción no se puede revertir.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '{{ $module->color }}',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.submit();
                                    }
                                })">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.modules.edit', [$module->name, $row->id]) }}" class="bg-primary/10 text-primary hover:bg-primary hover:text-white h-10 w-10 flex items-center justify-center rounded-xl transition shadow-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="bg-accent/10 text-accent hover:bg-accent hover:text-white h-10 w-10 flex items-center justify-center rounded-xl transition shadow-sm" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($module->fields) + 2 }}" class="px-8 py-20 text-center">
                        <div class="text-gray-400 font-medium italic">Aún no hay registros en este módulo.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
