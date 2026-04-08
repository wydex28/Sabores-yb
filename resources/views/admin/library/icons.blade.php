@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.index') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Panel
    </a>
</div>

<div class="mb-10 text-center">
    <h2 class="text-4xl font-display text-textMain tracking-tight uppercase">Galería de Iconos</h2>
    <p class="text-gray-500 font-medium italic">Explora los iconos disponibles para categorías y módulos.</p>
</div>

<div class="mb-10 max-w-xl mx-auto">
    <div class="relative group">
        <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-400">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" id="icon-search" placeholder="Busca un icono (ej: pizza, car, box)..." class="w-full bg-white border border-gray-100 rounded-3xl py-5 pl-14 pr-6 text-sm font-bold shadow-xl shadow-gray-200/50 focus:ring-4 focus:ring-primary/10 transition-all outline-none">
    </div>
</div>

<div class="space-y-12">
    @foreach($icons as $category => $list)
    <div class="icon-section mb-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-2 mb-6 cursor-pointer group" onclick="toggleSection(this)">
            <h3 class="text-xl font-display text-primary flex items-center gap-3 uppercase tracking-widest">
                <i class="fas fa-layer-group text-sm opacity-50"></i> {{ $category }}
            </h3>
            <i class="fas fa-chevron-down text-gray-300 group-hover:text-primary transition-transform duration-300 {{ $loop->first ? 'rotate-180' : '' }}"></i>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 icon-grid {{ $loop->first ? '' : 'hidden' }}">
            @foreach($list as $icon)
            <div class="icon-card group bg-white p-6 rounded-3xl border border-gray-50 flex flex-col items-center justify-center text-center transition-all hover:shadow-xl hover:shadow-gray-200/50 hover:border-primary/20 cursor-pointer" onclick="copyIcon('{{ $icon }}')">
                <div class="h-12 w-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition mb-3">
                    <i class="{{ $icon }} text-2xl"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter truncate w-full group-hover:text-textMain">{{ str_replace('fas fa-', '', $icon) }}</span>
                
                <div class="mt-2 opacity-0 group-hover:opacity-100 transition">
                    <span class="text-[8px] bg-dark/10 text-dark px-2 py-0.5 rounded-full font-bold">CLICK PARA COPIAR</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<script>
    // Toggle de secciones
    function toggleSection(header) {
        const grid = header.nextElementSibling;
        const chevron = header.querySelector('.fa-chevron-down');
        grid.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }

    // Buscador en tiempo real
    document.getElementById('icon-search').addEventListener('input', function(e) {
        let q = e.target.value.toLowerCase();
        document.querySelectorAll('.icon-card').forEach(card => {
            let name = card.querySelector('span').innerText.toLowerCase();
            if (name.includes(q)) {
                card.style.display = 'flex';
                card.closest('.icon-section').style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Ocultar secciones vacías y expandir las que tienen resultados
        document.querySelectorAll('.icon-section').forEach(section => {
            let visibleCards = section.querySelectorAll('.icon-card[style="display: flex;"]').length;
            const grid = section.querySelector('.icon-grid');
            const chevron = section.querySelector('.fa-chevron-down');

            if (visibleCards === 0 && q !== '') {
                section.style.display = 'none';
            } else {
                section.style.display = 'block';
                if (q !== '') {
                    grid.classList.remove('hidden');
                    chevron.classList.add('rotate-180');
                }
            }
        });
    });

    // Copiar al portapapeles con fallback para contextos no seguros
    function copyIcon(code) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(() => {
                showSuccess(code);
            });
        } else {
            // Fallback para HTTP o entornos sin clipboard API
            const textArea = document.createElement("textarea");
            textArea.value = code;
            textArea.style.position = "fixed";
            textArea.style.left = "-9999px";
            textArea.style.top = "0";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                showSuccess(code);
            } catch (err) {
                console.error('Error al copiar:', err);
            }
            document.body.removeChild(textArea);
        }
    }

    function showSuccess(code) {
        Swal.fire({
            icon: 'success',
            title: 'Copiado',
            text: code + ' copiado al portapapeles.',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
</script>
@endsection
