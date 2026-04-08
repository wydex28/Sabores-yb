@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.modules.index', $module->name) }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver a {{ $module->name }}
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="mb-10 text-center">
        <div class="inline-flex h-16 w-16 rounded-2xl items-center justify-center text-white mb-4 shadow-lg shadow-dark/20" style="background-color: {{ $module->color }}">
            <i class="{{ $module->icon }} text-2xl"></i>
        </div>
        <h2 class="text-4xl font-display text-textMain tracking-tight">Nuevo {{ $module->name }}</h2>
        <p class="text-gray-500 font-medium italic">Completa los campos definidos en el módulo.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] p-10 sm:p-14 shadow-2xl shadow-gray-200/50 border border-gray-100">
        <form action="{{ route('admin.modules.store', $module->name) }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($module->fields as $field)
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">{{ \Illuminate\Support\Str::title($field['name']) }}</label>
                    @if($field['type'] == 'text' || $field['type'] == 'textarea')
                        <textarea name="{{ $field['name'] }}" rows="3" class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required></textarea>
                    @elseif($field['type'] == 'integer' || $field['type'] == 'decimal')
                        <input type="number" step="any" name="{{ $field['name'] }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                    @else
                        <input type="text" name="{{ $field['name'] }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 focus:ring-4 focus:ring-primary/10 transition-all text-sm font-bold" required>
                    @endif
                </div>
                @endforeach

                @if($module->relations)
                    @foreach($module->relations as $rel)
                        @if($rel['type'] == 'belongsTo')
                        @php $fk = \Illuminate\Support\Str::snake($rel['model']) . '_id'; @endphp
                        <div>
                            <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">{{ $rel['model'] }}</label>
                            <select name="{{ $fk }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold select2" required>
                                <option value="">Selecciona {{ $rel['model'] }}</option>
                                @foreach(($relatedData[$rel['model']]['data'] ?? []) as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->{$relatedData[$rel['model']]['display_column']} ?? $item->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-green-700 text-white font-extra-bold py-5 rounded-3xl shadow-xl shadow-bg-primary/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg mt-10">
                <i class="fas fa-save text-xl"></i> Guardar {{ $module->name }}
            </button>
        </form>
    </div>
</div>
@endsection
