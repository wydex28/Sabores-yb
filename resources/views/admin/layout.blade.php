<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sabores Y&B</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Lilita+One&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A859',
                        secondary: '#FFBF69',
                        accent: '#E71D36',
                        dark: '#2EC4B6',
                        light: '#FDFFFC',
                        textMain: '#24140a'
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        display: ['Lilita One', 'cursive']
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fefefe; }
        .font-display { font-family: 'Lilita One', cursive; }
        /* Branded SweetAlert Style */
        .swal2-popup { border-radius: 2rem !important; font-family: 'Outfit', sans-serif !important; }
        .swal2-styled.swal2-confirm { background-color: #00A859 !important; border-radius: 1rem !important; font-weight: bold !important; px: 2rem !important; }
        .swal2-styled.swal2-cancel { border-radius: 1rem !important; font-weight: bold !important; }
    </style>
</head>
<body class="bg-gray-50 text-textMain min-h-screen flex flex-col">
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-3">
                    <a href="/" class="shrink-0 flex items-center">
                        <img src="/images/brand/logo.png" alt="Logo" class="h-10 w-auto">
                    </a>
                    <div class="h-6 w-px bg-gray-200 hidden sm:block mx-1"></div>
                    <span class="font-display text-2xl text-primary tracking-wide">Panel Administrativo</span>
                </div>
                <div class="flex items-center gap-4">
                    @if(session('admin_logged_in'))
                        <a href="{{ route('admin.index') }}" class="text-sm font-bold text-gray-500 hover:text-primary transition">Gestión</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="bg-accent/10 text-accent hover:bg-accent hover:text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                                <i class="fas fa-sign-out-alt"></i> Salir
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <ul class="list-disc list-inside font-bold">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-gray-400 font-medium">
        &copy; {{ date('Y') }} Sabores Y&B - Sistema Dinámico de Gestión
    </footer>
</body>
</html>
