<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Conoce la historia detrás de {{ $appName }}. Tradición, familia y las mejores empanadas venezolanas hechas con amor.">
    <meta name="keywords" content="historia {{ strtolower($appName) }}, empanadas, familia, tradición venezolana, comida con amor">
    <meta name="author" content="{{ $appName }}">
    <meta property="og:title" content="{{ $appName }} | Nuestra Historia">
    <meta property="og:description"
        content="Descubre cómo nació {{ $appName }}, una tradición familiar de las mejores empanadas.">
    <meta property="og:image" content="/images/brand/logo.png">
    <meta property="og:type" content="website">
    <title>{{ $appName }} | Nuestra Historia</title>

    <!-- Favicon & PWA -->
    <link rel="icon" type="image/png" href="assets/images/brand/logo.png">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#00A859">
    <!-- Mobile Optimization -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ $appName }}">
    <link rel="apple-touch-icon" href="/images/brand/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Lilita+One&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS (Local) -->
    <script src="assets/js/tailwindcss.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A859',    /* Green (Logo) */
                        secondary: '#FFBF69',  /* Light Orange */
                        accent: '#E71D36',     /* Redish */
                        dark: '#2EC4B6',       /* Teal accent */
                        light: '#FDFFFC',      /* Off White */
                        textMain: '#24140a'
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        display: ['Lilita One', 'cursive']
                    },
                    keyframes: {
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '25%': { transform: 'translateX(-4px)' },
                            '75%': { transform: 'translateX(4px)' },
                        }
                    },
                    animation: {
                        'shake': 'shake 0.3s ease-in-out infinite',
                        'shake-slow': 'shake 2s ease-in-out infinite'
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome for Icons (CDN para garantizar nuevos iconos como X) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS Base -->
    <style>
        body {
            background-color: #FDFFFC;
            color: #24140a;
        }

        /* Smooth reveal animation for elements */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Nice blob background for hero */
        .hero-blob {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 159, 28, 0.2) 0%, rgba(255, 159, 28, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .food-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .food-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .counter-btn:active {
            transform: scale(0.9);
        }

        /* Attention-grabbing shake animation */
        @keyframes shake-btn {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-2px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(2px);
            }
        }

        .animate-shake-attention {
            animation: shake-btn 5s cubic-bezier(.36, .07, .19, .97) infinite;
        }

        /* Adjustments for Installed App (Standalone) Mode */
        @media (display-mode: standalone) {
            #navbar .nav-logo {
                height: 3rem !important;
            }

            /* h-12 instead of h-14 */
            footer {
                display: none !important;
            }
        }
    </style>
</head>

<body class="font-sans antialiased overflow-x-hidden relative">

    <!-- Splash Screen / Loading View (App launch simulation) -->
    <div id="pwa-splash" class="fixed inset-0 bg-white z-[1000] flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="flex flex-col items-center animate-pulse">
            <img src="/images/brand/logo.png" alt="{{ $appName }}" class="w-48 h-48 object-contain mb-4">
            <h1 class="text-3xl font-display text-textMain tracking-wide">{{ $appName }}</h1>
        </div>
        <div class="absolute bottom-12 left-0 w-full text-center">
            <p class="text-gray-300 text-[10px] font-mono tracking-widest">VERSION 1.0.0</p>
        </div>
    </div>

    <!-- PWA Installation Modal (Onboarding) -->
    <div id="install-pwa-modal"
        class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div
            class="bg-white rounded-[2.5rem] p-8 max-w-sm w-full shadow-2xl transform scale-95 transition-transform duration-300 relative overflow-hidden text-center border border-orange-100">
            <!-- Decorative blur background -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-accent/10 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <h2 class="text-2xl font-display font-medium text-textMain mb-2">¡{{ $appName }} en el Inicio de tu
                    dispositivo!</h2>

                <!-- Company Logo -->
                <div class="flex justify-center mb-6">
                    <img src="/images/brand/logo.png" alt="{{ $appName }}" class="w-28 h-28 object-contain drop-shadow-md hover:scale-105 transition-transform duration-500">
                </div>

                <!-- Android Specific Section -->
                <div id="android-install-view" class="hidden animate-in fade-in zoom-in duration-300">
                    <p class="text-gray-600 mb-8 text-sm leading-relaxed font-medium">Instala nuestra App para pedir más
                        rápido y recibir notificaciones.</p>
                    <button id="btn-pwa-install-now"
                        class="w-full bg-gradient-to-r from-primary to-green-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-95 transition-all text-base mb-3">
                        Instalar aplicación
                    </button>
                </div>

                <!-- iOS Specific Section -->
                <div id="ios-install-view" class="hidden animate-in fade-in zoom-in duration-300">
                    <p class="text-gray-600 mb-6 text-sm leading-relaxed font-medium">Instala nuestra App para pedir más
                        rápido.</p>

                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl text-left mb-6">
                        <p class="text-xs text-blue-700 font-medium mb-3 leading-relaxed text-center">
                            Sigue estos pasos en tu iPhone/iPad:
                        </p>
                        <ol class="text-[11px] text-blue-600 space-y-2 list-decimal list-inside ml-1 font-medium">
                            <li>Presiona el botón <span
                                    class="bg-white px-1.5 py-0.5 rounded border border-blue-200">Compartir <i
                                        class="far fa-share-square"></i></span></li>
                            <li>Selecciona <span class="bg-white px-1.5 py-0.5 rounded border border-blue-200">"Añadir a
                                    la pantalla de inicio" <i class="far fa-plus-square"></i></span></li>
                            <li>Pulsa <span class="font-bold text-blue-800 underline">Añadir</span> en la esquina
                                superior.</li>
                        </ol>
                    </div>
                </div>

                <button id="btn-pwa-close-modal"
                    class="w-full bg-gray-50 text-gray-400 font-semibold py-3 rounded-2xl hover:bg-gray-100 transition-colors text-sm">
                    Luego
                </button>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-md shadow-sm z-40 top-0 left-0 transition-all duration-300"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="flex-shrink-0 flex items-center space-x-3 cursor-pointer">
                    <img class="h-20 w-auto drop-shadow-md nav-logo hover:scale-105 transition-transform duration-300" src="/images/brand/logo.png"
                        alt="{{ $appName }} Logo">
                    <span class="font-display tracking-wide text-xl text-primary drop-shadow-sm hidden sm:block">{{ $appName }}</span>
                </a>

                <!-- Navbar BCV Rate Display -->
                <div class="flex-grow flex flex-col items-center justify-center md:flex-initial mx-2">
                    <div id="bcv-rate-navbar"
                        class="bg-blue-50 border border-blue-100 px-3 py-1 rounded-full shadow-sm flex items-center gap-2 whitespace-nowrap leading-none">
                        <span class="text-blue-800 font-bold text-sm sm:text-base">
                            <i class="fas fa-money-bill-wave mr-1 text-green-600"></i> Tasa BCV: <span
                                class="rate-val text-green-600 ml-1">...</span>
                        </span>
                    </div>
                    <span id="bcv-date" class="text-[10px] sm:text-xs text-gray-500 font-medium mt-1"></span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="index.html" class="text-gray-800 hover:text-primary font-semibold transition">Menú</a>
                    <a href="about.html"
                        class="text-gray-800 hover:text-primary font-semibold transition border-b-2 border-primary">Nuestra
                        Historia</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-gray-800 hover:text-primary focus:outline-none" id="mobile-menu-btn">
                        <i class="fas fa-bars text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Schedule & Location Banner -->
        <div class="bg-primary py-1.5 border-t border-white/10">
            <div
                class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-4 text-xs sm:text-sm font-bold text-white sm:whitespace-nowrap sm:overflow-x-auto scrollbar-hide">
                <div class="flex flex-row items-center gap-2">
                    <span id="schedule-text" class="flex items-center gap-1.5">
                        <i class="fas fa-clock text-white/80"></i> Lunes a Sábado de 6:00 am a 1:00 pm
                    </span>
                    <span id="store-status-badge"
                        class="px-2 py-0.5 text-[9px] sm:text-[10px] rounded-full uppercase tracking-wider font-extrabold shadow-sm transition-colors duration-300"></span>
                </div>
                <span class="opacity-30 hidden sm:inline">|</span>
                <a href="https://maps.app.goo.gl/q1pFAsYWsYEuoX4i6" target="_blank"
                    class="flex items-center gap-1.5 hover:text-white/80 transition group">
                    <i class="fas fa-map-marker-alt text-red-500/80 group-hover:animate-bounce"></i>
                    <span
                        class="underline decoration-2 underline-offset-4 decoration-red-500/30 group-hover:decoration-red-500">Ubícanos en Maracay</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Layer -->
    <div id="mobile-menu"
        class="fixed inset-0 bg-white z-50 flex flex-col justify-center items-center text-3xl space-y-8 font-display hidden opacity-0 transition-opacity duration-300">
        <button id="close-mobile-menu" class="absolute top-6 right-8 text-4xl text-gray-800"><i
                class="fas fa-times"></i></button>
        <a href="index.html" class="text-textMain hover:text-primary transition">Menú</a>
        <a href="about.html" class="text-textMain hover:text-primary transition">Nuestra Historia</a>
    </div>

    <!-- Hero Section -->
    <section id="inicio" class="relative pt-36 pb-10 lg:pt-48 lg:pb-16 overflow-hidden">
        <div class="hero-blob"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left reveal active">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-secondary text-primary font-semibold text-sm mb-4 tracking-wide uppercase">Tradición
                        Venezolana</span>
                    <h1 class="text-5xl md:text-7xl font-display text-textMain leading-tight mb-6">
                        El auténtico sabor <br /> <span class="text-primary">en cada bocado</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg mx-auto lg:mx-0">
                        Croocantes por fuera, rellenas de amor y tradición por dentro. Disfruta de las mejores empanadas
                        venezolanas hechas como en casa.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/"
                            class="px-8 py-4 bg-primary text-white font-bold rounded-full shadow-lg hover:bg-green-600 hover:shadow-primary/50 hover:-translate-y-1 transition-all duration-300 text-center">
                            Ver el Menú Completo
                        </a>
                        <a href="#historia"
                            class="px-8 py-4 bg-white text-textMain border-2 border-gray-200 font-bold rounded-full hover:border-primary hover:text-primary transition duration-300 text-center">
                            Conocer Nuestra Historia
                        </a>
                    </div>
                </div>
                <div class="relative reveal active lg:ml-10">
                    <div
                        class="absolute inset-0 bg-secondary rounded-full transform -rotate-6 scale-105 opacity-50 blur-xl">
                    </div>
                    <img src="assets/images/empanadas/pabellon.png" alt="Empanada de Pabellón"
                        class="relative rounded-3xl shadow-2xl object-cover h-[500px] w-full border-4 border-white transform hover:scale-[1.02] transition duration-500">

                    <!-- Floating badge -->
                    <div
                        class="absolute -right-6 top-10 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center space-x-3 bounce-slow">
                        <div class="bg-yellow-100 p-2 rounded-full text-yellow-500">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm leading-none">¡Receta de la Abuela!</p>
                            <p class="text-xs text-gray-500 mt-1">100% Caseras</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="historia" class="py-12 bg-orange-50 relative">
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none z-0">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    fill="#FDFFFC"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-6">
            <div class="text-center mb-16 reveal">
                <h2 class="text-4xl text-primary font-display mb-4">La Receta de Mamá</h2>
                <div class="w-24 h-1 bg-accent mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1 reveal">
                    <img src="assets/images/brand/logo.png" alt="Sabores Y&B" class="w-full max-w-md mx-auto drop-shadow-2xl">
                </div>
                <div class="order-1 md:order-2 reveal text-lg text-gray-700 space-y-6">
                    <p>
                        <strong class="text-primary font-bold text-xl">{{ $appName }}</strong> nace del corazón de nuestra
                        cocina familiar. Hace más de 20 años, mi mamá preparaba estas mismas empanadas los domingos por
                        la mañana, llenando la casa de un aroma incomparable que despertaba a toda la familia.
                    </p>
                    <p>
                        Con la misma masa de maíz amarillo, el guiso preparado a fuego lento y "ese toquecito secreto"
                        de la abuela, hoy queremos compartir nuestra tradición contigo. Cada empanada que pruebas aquí
                        está hecha a mano, con amor, dedicación y los mejores ingredientes frescos.
                    </p>
                    <p class="font-semibold text-textMain border-l-4 border-primary pl-4 italic">
                        "No es solo comida, es un viaje a los domingos en familia, es el sabor a hogar en cada
                        mordisco." - Mamá {{ $appName }}
                    </p>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    fill="#FDFFFC"></path>
            </svg>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-textMain py-8 text-white text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <img src="/images/brand/logo.png" alt="{{ $appName }}"
                class="h-16 mx-auto mb-4 brightness-0 invert opacity-90 footer-logo">
            <h5 class="text-2xl font-display mb-2 text-primary">{{ $appName }}</h5>
            <p class="text-gray-400 mb-6 max-w-sm mx-auto text-sm">Hechas con amor desde nuestra familia para la tuya.
            </p>

            <div class="flex justify-center flex-wrap gap-x-8 gap-y-4 text-gray-300 font-bold mb-8 text-sm">
                @if($instagramUrl)
                <a href="{{ $instagramUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-instagram text-lg"></i> Instagram
                </a>
                @endif
                
                @if($tiktokUrl)
                <a href="{{ $tiktokUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-tiktok text-lg"></i> TikTok
                </a>
                @endif

                @if($facebookUrl)
                <a href="{{ $facebookUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-facebook text-lg"></i> Facebook
                </a>
                @endif

                @if($youtubeUrl)
                <a href="{{ $youtubeUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-youtube text-lg"></i> YouTube
                </a>
                @endif

                @if($twitterUrl)
                <a href="{{ $twitterUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-x-twitter text-lg"></i> X (Twitter)
                </a>
                @endif

                @if($telegramUrl)
                <a href="{{ $telegramUrl }}" target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-telegram text-lg"></i> Telegram
                </a>
                @endif

                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $whatsappNumber ?? '') }}?text=%C2%A1Hola%20{{ $appName }}!%20Quiero%20hacerles%20una%20consulta."
                    target="_blank" class="hover:text-primary transition flex items-center gap-2">
                    <i class="fab fa-whatsapp text-lg"></i> {{ $whatsappNumber ?? '' }}
                </a>
            </div>

            <div class="flex justify-center px-4 mb-6 text-sm text-gray-300 font-light text-center">
                <a href="https://maps.app.goo.gl/q1pFAsYWsYEuoX4i6" target="_blank"
                    class="hover:text-primary transition max-w-lg">
                    Los olivos nuevos - Calle Andres Bello - al frente del Colegio Nuestra Señora de las Mercedes
                </a>
            </div>

            <div class="border-t border-gray-700 pt-6 flex flex-col items-center justify-center">
                <button id="btn-test-notification" class="mb-4 text-[10px] text-gray-500 hover:text-primary transition underline decoration-1">
                    <i class="fas fa-bell mr-1"></i> Probar Notificación de las 7AM (Vista previa)
                </button>
                <div class="text-xs text-gray-500 text-center">
                    &copy; {{ date('Y') }} {{ $appName }}. Todos los derechos reservados.
                </div>
                <div class="text-xs text-gray-400 mt-2 flex items-center justify-center gap-1">
                    <span>Desarrollado con</span>
                    <i class="fas fa-heart text-red-500 animate-pulse"></i>
                    <span>por</span>
                    <a href="https://github.com/wydex28" target="_blank"
                        class="text-primary hover:text-green-400 font-bold transition flex items-center gap-1 hover:-translate-y-0.5 hover:scale-105"
                        title="Creador: wydex28">
                        <i class="fab fa-github text-sm"></i> wydex28
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Logica para mostrar splash SOLO en modo APP instalada
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
            
            function hideSplash() {
                setTimeout(function() {
                    $('#pwa-splash').addClass('opacity-0 pointer-events-none');
                    setTimeout(() => $('#pwa-splash').addClass('hidden'), 600);
                }, 1500);
            }

            if (!isStandalone) {
                // Si es navegador normal, ocultar de inmediato sin animación
                $('#pwa-splash').addClass('hidden');
            } else {
                // Si es App, esperar a que cargue todo para quitarlo
                if (document.readyState === 'complete') {
                    hideSplash();
                } else {
                    $(window).on('load', hideSplash);
                }
            }

            // Tasa BCV Logic
            let bcvRate = 1.0;
            async function fetchBcvRate() {
                try {
                    const response = await fetch('https://ve.dolarapi.com/v1/dolares/oficial');
                    const data = await response.json();
                    if (data && data.promedio) {
                        bcvRate = data.promedio;
                        $('#bcv-rate-navbar .rate-val').text(`Bs. ${bcvRate.toFixed(2)}`);
                        if (data.fechaActualizacion) {
                            let dateObj = new Date(data.fechaActualizacion);
                            $('#bcv-date').text('Actualizado: ' + dateObj.toLocaleString('es-VE', { dateStyle: 'short', timeStyle: 'short' }));
                        }
                    }
                } catch (error) {
                    console.error("Error fetching BCV rate:", error);
                    $('#bcv-rate-navbar .rate-val').text(`Bs. -- (Ref)`);
                }
            }
            fetchBcvRate();

            // Horario Logic
            function updateScheduleBadge() {
                var now = new Date();
                var day = now.getDay(); // 0-6: Sun-Sat
                var hours = now.getHours();

                var isSunday = (day === 0);
                var isOpenTime = (hours >= 6 && hours < 13);
                var isStoreOpen = !isSunday && isOpenTime;

                var badge = $('#store-status-badge');
                if (isStoreOpen) {
                    badge.text('Abierto').removeClass('bg-red-500 border-red-400 text-white').addClass('bg-green-100 text-green-800 border-green-300');
                } else {
                    badge.text('Cerrado').removeClass('bg-green-100 text-green-800 border-green-300').addClass('bg-red-500 text-white border-red-400');
                }
            }
            updateScheduleBadge();
            setInterval(updateScheduleBadge, 60000);

            // Navbar Background on Scroll
            $(window).scroll(function () {
                if ($(window).scrollTop() > 50) {
                    $('#navbar').addClass('shadow-md bg-white/95').removeClass('bg-white/90 shadow-sm');
                } else {
                    $('#navbar').removeClass('shadow-md bg-white/95').addClass('bg-white/90 shadow-sm');
                }

                // Reveal animations
                $('.reveal').each(function () {
                    var windowHeight = $(window).height();
                    var elementTop = $(this).offset().top;
                    var elementVisible = 100;
                    if (elementTop < $(window).scrollTop() + windowHeight - elementVisible) {
                        $(this).addClass('active');
                    }
                });
            });

            // Initial trigger
            setTimeout(function () { $(window).trigger('scroll'); }, 100);

            // Mobile menu
            $('#mobile-menu-btn').click(function () {
                $('#mobile-menu').removeClass('hidden').toggleClass('opacity-0 opacity-100');
            });
            $('#close-mobile-menu, #mobile-menu a').click(function () {
                $('#mobile-menu').removeClass('opacity-100').addClass('opacity-0');
                setTimeout(function () { $('#mobile-menu').addClass('hidden'); }, 300);
            });

            // Smooth scrolling
            $('a[href^="#"]').on('click', function (e) {
                var target = this.hash;
                if (target) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 80
                    }, 600, 'swing');
                }
            });

            // Logica para probar notificación local
            $('#btn-test-notification').click(function () {
                if (!("Notification" in window)) {
                    alert("Este navegador no soporta notificaciones de escritorio.");
                    return;
                }

                if (Notification.permission === "granted") {
                    sendTestNotification();
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") sendTestNotification();
                    });
                } else {
                    alert("Permiso de notificación denegado. Actívalo en la configuración de la página.");
                }
            });

            function sendTestNotification() {
                const title = "¡Es hora de una empanada! 🥟";
                const options = {
                    body: "Crujientes, calientes y deliciosas. ¡Pide la tuya ahora en {{ $appName }}!",
                    icon: "/images/brand/logo.png",
                    image: "/images/brand/logo.png",
                    badge: "/images/brand/logo.png",
                    vibrate: [200, 100, 200],
                    tag: 'test-notification',
                    renotify: true
                };

                if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
                    navigator.serviceWorker.ready.then(registration => {
                        registration.showNotification(title, options);
                    });
                } else {
                    // Fallback for desktop or non-SW env
                    try {
                        const n = new Notification(title, options);
                        n.onclick = () => { window.focus(); n.close(); };
                    } catch (e) {
                        console.error("Error enviando notificación:", e);
                    }
                }
            }
        });
    </script>
    <!-- Service Worker Registration & PWA Install -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('./sw.js').catch(err => { });
            });
        }

        let deferredPrompt;
        const installModal = document.getElementById('install-pwa-modal');
        const installNowBtn = document.getElementById('btn-pwa-install-now');
        const closeModalBtn = document.getElementById('btn-pwa-close-modal');
        const androidView = document.getElementById('android-install-view');
        const iosView = document.getElementById('ios-install-view');

        // Detectar si ya está instalada
        const isAppInstalled = () => {
            return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
        }

        const isIOS = () => {
            return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
        };

        const showInstallModal = () => {
            if (isAppInstalled()) return;
            if (sessionStorage.getItem('pwa-modal-dismissed')) return;

            // Prioritize iOS Guide if on iOS, else Auto-Prompt
            if (isIOS()) {
                androidView.classList.add('hidden');
                iosView.classList.remove('hidden');
            } else if (deferredPrompt) {
                androidView.classList.remove('hidden');
                iosView.classList.add('hidden');
            } else {
                return;
            }

            installModal.classList.remove('hidden');
            installModal.classList.add('flex');
            setTimeout(() => {
                installModal.classList.remove('opacity-0');
                if (installModal.querySelector('.transition-transform')) {
                    installModal.querySelector('.transition-transform').classList.remove('scale-95');
                    installModal.querySelector('.transition-transform').classList.add('scale-100');
                }
            }, 10);
        };

        const hideInstallModal = () => {
            installModal.classList.add('opacity-0');
            installModal.querySelector('.scale-100').classList.remove('scale-100');
            installModal.querySelector('.transition-transform').classList.add('scale-95');
            setTimeout(() => {
                installModal.classList.add('hidden');
                installModal.classList.remove('flex');
            }, 300);
        };

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            setTimeout(showInstallModal, 3000);
        });

        // Trigger para iOS manualmente
        if (isIOS() && !isAppInstalled()) {
            setTimeout(showInstallModal, 3000);
        }

        installNowBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    hideInstallModal();
                }
                deferredPrompt = null;
            }
        });

        closeModalBtn.addEventListener('click', () => {
            sessionStorage.setItem('pwa-modal-dismissed', 'true');
            hideInstallModal();
        });

        window.addEventListener('appinstalled', () => {
            hideInstallModal();
            deferredPrompt = null;
        });
    </script>
</body>

</html>