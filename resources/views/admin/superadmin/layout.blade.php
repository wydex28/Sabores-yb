<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin | {{ $appName }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        @php
            $primary = \App\Models\Setting::get('primary_color', '#00A859');
            $secondary = \App\Models\Setting::get('secondary_color', '#FFBF69');
        @endphp
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '{{ $primary }}', secondary: '{{ $secondary }}', accent: '#E71D36', dark: '#2EC4B6', textMain: '#24140a' },
                    fontFamily: { sans: ['Outfit', 'sans-serif'], display: ['Lilita One', 'cursive'] }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-textMain min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-10 sticky top-0 z-50 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 bg-dark/10 rounded-xl flex items-center justify-center text-dark text-xl">
                <i class="fas fa-hammer"></i>
            </div>
            <a href="{{ route('superadmin.index') }}" class="font-display text-2xl text-dark tracking-wide">Panel Maestro</a>
        </div>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.index') }}" class="text-gray-400 font-bold hover:text-dark transition text-sm mr-4 hidden md:block">
                <i class="fas fa-arrow-left"></i> Ir al Panel Admin
            </a>
            <form action="{{ route('superadmin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-accent/10 text-accent hover:bg-accent hover:text-white px-5 py-2.5 rounded-2xl font-bold transition flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Salir</span>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 py-8 md:py-12">
        @if(session('success'))
            <div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl relative mb-8 flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle text-xl"></i>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-accent/10 border border-accent/20 text-accent px-6 py-4 rounded-2xl relative mb-8 flex items-center gap-3 shadow-sm">
                <i class="fas fa-exclamation-circle text-xl"></i>
                <div>
                    <ul class="list-disc list-inside font-bold text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success', title: '¡Éxito!', text: '{{ session("success") }}', confirmButtonText: 'Entendido',
            customClass: { confirmButton: 'bg-dark text-white px-6 py-3 rounded-xl font-bold' },
            buttonsStyling: false
        });
    </script>
    @endif
</body>
</html>
