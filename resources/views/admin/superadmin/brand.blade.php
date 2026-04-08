@extends('admin.superadmin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.index') }}" class="text-sm font-bold text-gray-400 hover:text-dark transition flex items-center gap-2 mb-6">
        <i class="fas fa-arrow-left text-xs"></i> Volver al Menú Maestro
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="mb-10 text-center">
        <div class="inline-flex h-16 w-16 rounded-2xl bg-dark/10 items-center justify-center text-dark mb-4 shadow-lg shadow-dark/20">
            <i class="fas fa-palette text-2xl"></i>
        </div>
        <h2 class="text-4xl font-display text-textMain tracking-tight mb-2 uppercase">Identidad de Marca</h2>
        <p class="text-gray-500 font-medium italic">Configura logos y colores corporativos globales.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] p-10 sm:p-14 shadow-2xl shadow-gray-200/50 border border-gray-100">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-primary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Color Principal</label>
                    <div class="flex items-center gap-4">
                        <input type="color" name="primary_color" value="{{ $settings['primary_color'] }}" class="h-16 w-16 rounded-2xl cursor-pointer shadow-sm">
                        <input type="text" value="{{ $settings['primary_color'] }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-gray-400" disabled>
                    </div>
                </div>
                <div>
                    <label class="block text-secondary text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Color Secundario</label>
                    <div class="flex items-center gap-4">
                        <input type="color" name="secondary_color" value="{{ $settings['secondary_color'] }}" class="h-16 w-16 rounded-2xl cursor-pointer shadow-sm">
                        <input type="text" value="{{ $settings['secondary_color'] }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-gray-400" disabled>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-t border-gray-100 pt-8">
                <div>
                    <label class="block text-textMain text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Logotipo Principal</label>
                    <div class="bg-gray-50 rounded-2xl p-6 flex flex-col items-center gap-4 border border-gray-100">
                        @if($settings['logo'])
                            <img src="{{ asset('storage/' . $settings['logo']) }}" class="h-20 contain shadow-sm">
                        @else
                            <div class="h-20 w-20 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 italic text-[10px]">Sin Logo</div>
                        @endif
                        <input type="file" name="logo" class="text-xs text-gray-400 w-full">
                    </div>
                </div>
                <div>
                    <label class="block text-textMain text-xs font-extra-bold uppercase tracking-widest mb-3 ml-1">Favicon (Icono del Navegador)</label>
                    <div class="bg-gray-50 rounded-2xl p-6 flex flex-col items-center gap-4 border border-gray-100">
                        @if($settings['favicon'])
                            <img src="{{ asset('storage/' . $settings['favicon']) }}" class="h-10 w-10 contain shadow-sm">
                        @else
                            <div class="h-10 w-10 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 italic text-[10px]">Sin Favicon</div>
                        @endif
                        <input type="file" name="favicon" class="text-xs text-gray-400 w-full">
                    </div>
                </div>
            </div>

            <div class="space-y-6 border-t border-gray-100 pt-8">
                <div>
                    <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Nombre de la Aplicación / Empresa</label>
                    <div class="relative">
                        <i class="fas fa-signature absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="app_name" value="{{ $settings['app_name'] }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Horarios de Atención</label>
                    <div class="relative">
                        <i class="fas fa-clock absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="schedule" value="{{ $settings['schedule'] }}" placeholder="Ej. Lunes a Sábado de 6am a 1pm" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                    </div>
                </div>

                <div>
                    <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Eslogan Mensaje Footer</label>
                    <div class="relative">
                        <i class="fas fa-quote-left absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="slogan" value="{{ $settings['slogan'] }}" placeholder="Ej. Hechas con amor..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                    </div>
                </div>

                <!-- Redes Sociales -->
                <div class="border-t border-gray-100 pt-8 mt-4">
                    <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-[0.2em] mb-6 ml-1 flex items-center gap-2">
                        <i class="fas fa-share-nodes"></i> Enlaces y Redes Sociales
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <i class="fab fa-instagram absolute left-5 top-1/2 -translate-y-1/2 text-pink-500 text-xl"></i>
                            <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] }}" placeholder="URL de Instagram" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative">
                            <i class="fab fa-tiktok absolute left-5 top-1/2 -translate-y-1/2 text-black text-xl"></i>
                            <input type="url" name="tiktok_url" value="{{ $settings['tiktok_url'] }}" placeholder="URL de TikTok" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative">
                            <i class="fab fa-facebook absolute left-5 top-1/2 -translate-y-1/2 text-blue-600 text-xl"></i>
                            <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] }}" placeholder="URL de Facebook" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative">
                            <i class="fab fa-youtube absolute left-5 top-1/2 -translate-y-1/2 text-red-600 text-xl"></i>
                            <input type="url" name="youtube_url" value="{{ $settings['youtube_url'] }}" placeholder="URL de YouTube (Canal)" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative">
                            <i class="fab fa-x-twitter absolute left-5 top-1/2 -translate-y-1/2 text-black text-xl"></i>
                            <input type="url" name="twitter_url" value="{{ $settings['twitter_url'] }}" placeholder="URL de X / Twitter" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative">
                            <i class="fab fa-telegram absolute left-5 top-1/2 -translate-y-1/2 text-sky-500 text-xl"></i>
                            <input type="url" name="telegram_url" value="{{ $settings['telegram_url'] }}" placeholder="URL de Telegram (Canal/Grupo)" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition">
                        </div>
                        <div class="relative md:col-span-2">
                            <i class="fab fa-whatsapp absolute left-5 top-1/2 -translate-y-1/2 text-green-500 text-xl"></i>
                            <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] }}" placeholder="WhatsApp (Ej: 584120000000)" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Ubicación (Texto)</label>
                        <div class="relative">
                            <i class="fas fa-map-location-dot absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="address" value="{{ $settings['address'] }}" placeholder="Ej. Maracay, Sector Centro" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Enlace de Google Maps</label>
                        <div class="relative">
                            <i class="fas fa-route absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="url" name="maps_link" value="{{ $settings['maps_link'] }}" placeholder="https://maps.app.goo.gl/..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-dark text-[10px] font-extra-bold uppercase tracking-widest mb-3 ml-1">Mensaje de Notificaciones PWA</label>
                    <div class="relative">
                        <i class="fas fa-bell-concierge absolute left-5 top-6 text-gray-400"></i>
                        <textarea name="notification_msg" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 pl-14 pr-6 text-textMain font-bold focus:bg-white focus:ring-4 focus:ring-dark/10 outline-none transition" rows="2" required>{{ $settings['notification_msg'] }}</textarea>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2 italic">* Este es el texto que verán los usuarios en las notificaciones push locales.</p>
                </div>
            </div>

            <button type="submit" class="w-full bg-dark hover:bg-teal-700 text-white font-extra-bold py-5 rounded-3xl shadow-xl shadow-teal-500/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg mt-10 uppercase tracking-widest">
                <i class="fas fa-save text-xl"></i> Guardar Cambios de Marca
            </button>
        </form>
    </div>
</div>
@endsection
