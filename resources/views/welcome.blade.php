<x-app-layout>
    <x-slot name="header">
        <meta name="google-site-verification" content="7_bY3XIJdKu9NqklEXca-NfnTiXalY1LEMPX0bq8n7s" />
    </x-slot>

   <div class="min-h-screen bg-slate-50 font-sans text-slate-900">

        <div id="loader"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
            <div class="flex gap-1">
                @for ($i = 0; $i < 5; $i++)
                    <span class="w-2 h-8 bg-blue-600 rounded-full animate-bounce"
                        style="animation-delay: {{ $i * 0.1 }}s"></span>
                @endfor
            </div>
        </div>

    
        <!-- <header
            class="relative w-full h-auto lg:h-[80vh] lg:min-h-[600px] flex items-center justify-center overflow-hidden bg-white">
            <div class="relative lg:absolute lg:inset-0 z-0 w-full">
                <img src="/images/hero.png" class="w-full h-auto lg:h-full object-contain lg:object-cover"
                    alt="Church Sanctuary">

                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/10 to-transparent pointer-events-none">
                </div>
            </div>
        </header> -->

                      <section class="max-w-6xl mx-auto px-4 py-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <div class="relative aspect-video bg-black group">
                    <video id="liveVideo" autoplay muted controls playsinline class="w-full h-full"></video>

                    <div id="offlineCover"
                        class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/95 text-white hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-slate-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 4.243a5 5 0 01-7.072 0m0 0l2.829-2.829m-4.243-4.243a9 9 0 0112.728 0m0 0l-2.829 2.829" />
                        </svg>
                        <p class="text-xl font-medium">Broadcast is currently offline</p>
                    </div>
                </div>

                <div class="p-6 flex flex-wrap items-center justify-between gap-4 bg-white border-t border-slate-50">
                    <div class="flex items-center gap-3">
                        <span id="liveStatus"
                            class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-200 text-slate-600">Checking...</span>
                        <h2 id="nowPlaying" class="text-slate-700 font-semibold">Now Playing: CE Lekki Sunday Service</h2>
                    </div>
                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="bi bi-eye text-blue-500"></i>
                        <span id="viewerCount" class="font-mono font-bold text-lg">0</span>
                    </div>
                </div>
            </div>
        </section> 


        <section class="py-10 bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex flex-col md:flex-row shadow-lg bg-white border border-slate-100 overflow-hidden">

                    <div class="md:w-1/2 p-6 lg:p-8 flex flex-col justify-center">
                        <div
                            class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-4 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Worship with Us</h3>
                        <address class="not-italic text-sm text-slate-600 mb-6 leading-snug">
                            <span class="text-blue-600 font-bold">Christ Embassy Lekki</span><br>
                            LoveWorld Arena, Aare Bashiru Street, Chisco B/S<br>
                            Lekki-Epe Expressway, Lagos
                        </address>

                        <div class="space-y-3 mb-6">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Get
                                Directions</label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <input type="text" id="startLocation" placeholder="Enter your location (e.g. Ikeja)"
                                    class="flex-grow px-3 py-2 text-sm rounded-md border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">

                                <button id="getDirectionsBtn"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 text-sm rounded-md font-bold transition-all active:scale-95">
                                    Get Route
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 pt-2 border-t border-slate-50">
                            <p class="text-slate-500 text-xs flex items-center gap-2">
                                <i class="bi bi-telephone-fill text-blue-600"></i> +234 907 641 5312
                            </p>
                            <a href="https://www.celz5.org/locator"
                                class="text-xs font-bold text-blue-600 hover:underline">🌍 Locate Other Churches</a>
                        </div>
                    </div>

                    <div class="md:w-1/2 min-h-[300px] bg-slate-200">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.717148530368!2d3.4735399!3d6.4303493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf44bd8339175%3A0x6b2e3228833989ad!2sChrist%20Embassy%20Lekki!5e0!3m2!1sen!2sng!4v1710920000000!5m2!1sen!2sng"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>

        <div class="py-16 space-y-24">

            <section class="max-w-6xl mx-auto px-6 py-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
                    <div class="flex items-center justify-center transition-all duration-500 order-2 lg:order-1">
                        <div
                            class="w-full aspect-video overflow-hidden shadow-xl bg-slate-950 border border-white/10 relative group">
                            <video controls preload="metadata" poster="/images/sons3.png"
                                class="w-full h-full object-cover">
                                <source
                                    src="https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/EP16_5a085fe4f916b95c0f2f58e9.mp4"
                                    type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <div
                        class="bg-white shadow-lg border border-slate-100 p-8 flex flex-col justify-center items-start transition-all duration-500 hover:shadow-xl order-1 lg:order-2">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-sm bg-blue-50 text-blue-600 text-[9px] font-bold uppercase tracking-[0.2em] mb-4">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            Featured Program
                        </span>
                        <h2 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">The Higher Life</h2>
                        <div class="border-l-4 border-blue-400 pl-4 mb-6">
                            <p class="text-base text-slate-600 leading-relaxed">With Pastor Deola Phillips. A refreshing
                                time with the Word and divine encounters.</p>
                        </div>
                        <a href="/h-life"
                            class="inline-flex items-center gap-2.5 px-6 py-2.5 rounded-md border border-slate-200 text-blue-500 text-sm font-bold hover:bg-blue-600 hover:text-white transition-all group">
                            Other Episodes
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-4 py-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
                    <div
                        class="bg-white shadow-lg border border-slate-100 p-8 flex flex-col justify-center items-start transition-all duration-500 hover:shadow-xl">
                        <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">50 Days of
                            Blessings</h2>
                        <div class="border-l-4 border-blue-400 pl-4 mb-6">
                            <p class="text-base text-slate-600 leading-relaxed">A sacred season of spiritual growth.
                                Every morning and evening, receive divine truth.</p>
                        </div>
                        <a href="https://anightofblessings.org/blog"
                            class="inline-flex items-center gap-2.5 px-6 py-2.5 rounded-md border border-slate-200 text-blue-500 text-sm font-bold hover:bg-blue-600 hover:text-white transition-all group">View
                            Archive</a>
                    </div>
                    <div class="flex items-center justify-center transition-all duration-500">
                        <div class="w-full aspect-video overflow-hidden shadow-xl bg-slate-900 border border-white/10">
                            <video controls preload="metadata" poster="/images/50-days.jpg"
                                class="w-full h-full object-cover">
                                <source
                                    src="https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/D43MASUP_61c461d1efb1d00007d781ed.mp3">
                            </video>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-4 py-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">
                    <div class="flex items-center justify-center transition-all duration-500 order-2 lg:order-1">
                        <div class="w-full aspect-video overflow-hidden shadow-xl bg-slate-900 border border-white/10">
                            <video controls preload="metadata" poster="/images/kemi.png"
                                class="w-full h-full object-cover">
                                <source
                                    src="https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/new-test_601699fe3ccc7b0007cbc451.mp4"
                                    type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <div
                        class="bg-white shadow-lg border border-slate-100 p-8 flex flex-col justify-center items-start transition-all duration-500 hover:shadow-xl order-1 lg:order-2">
                        <h2
                            class="text-2xl lg:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight leading-tight uppercase">
                            Healed from Multiple Myeloma</h2>
                        <div class="border-l-4 border-blue-400 pl-4 mb-6">
                            <p class="text-base text-slate-600 leading-relaxed italic">"In 2019, she was diagnosed with
                                bone marrow cancer... the power of God healed her completely."</p>
                        </div>
                        <a href="/testimonies"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-md border border-slate-200 text-blue-500 text-sm font-bold hover:bg-blue-600 hover:text-white transition-all duration-300 group">
                            Watch More Testimonies
                            <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </section>
        </div>

        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
            <div id="miniChatBox"
                class="hidden w-64 bg-white rounded-xl shadow-2xl border border-slate-200 mb-4 overflow-hidden">
                <div class="bg-blue-600 p-3 text-white text-sm font-bold">Chat with us</div>
                <div class="p-4 text-xs text-slate-500">Click the button below to message us directly on KingsChat.
                </div>
                <div class="p-3">
                    <a href="https://www.kingsch.at/p/eUM3MVd" target="_blank"
                        class="block bg-blue-600 text-white text-center py-2 rounded-lg text-sm">Start Chat</a>
                </div>
            </div>

            <button onclick="toggleChat()"
                class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center shadow-xl border-2 border-white/20 active:scale-95 transition-transform">
                <img src="/images/unnamed.png" class="w-10 h-10 object-contain" alt="Icon">
            </button>
        </div>

        <footer class="relative font-sans text-slate-200 overflow-hidden">
    <div class="absolute inset-0 bg-slate-950 [background:radial-gradient(circle_at_center,_#0f172a_0%,_#020617_100%)] opacity-95"></div>

    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.03] mix-blend-overlay"></div>

    <div class="relative z-10 bg-white/5 backdrop-blur-2xl border-y border-white/5 py-4 shadow-2xl">
        <div class="max-w-7xl mx-auto px-6 flex flex-wrap items-center justify-center sm:justify-between gap-6">
            <span class="text-blue-400 font-semibold italic">Get connected with us on social media networks:</span>

            <div class="flex items-center gap-6">
                <a href="tiktok.com/@christembassylekki" class="text-slate-400 hover:text-white hover:-translate-y-1.5 transition-all duration-300 hover:drop-shadow-[2px_0_0_#fe2c55] hover:filter drop-shadow-[-2px_0_0_#25f4ee]">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.06-2.89-.44-4.13-1.19-.29-.17-.57-.38-.82-.61-.01 1.89-.01 3.78-.01 5.67 0 1.15-.27 2.33-.89 3.29-.75 1.14-1.9 1.94-3.21 2.29-1.32.33-2.78.21-4.02-.34-1.21-.54-2.22-1.49-2.81-2.69-.6-1.14-.8-2.48-.56-3.74.24-1.28.94-2.44 1.96-3.21 1.05-.79 2.41-1.21 3.74-1.14 0 1.39.01 2.78.01 4.17-.65-.06-1.34.05-1.9.39-.58.34-.98.93-1.1 1.59-.14.73.08 1.51.57 2.06.49.54 1.23.82 1.94.75.73-.07 1.39-.47 1.74-1.1.22-.39.3-.84.29-1.29-.02-4.99-.01-9.97-.01-14.96z" /></svg>
                </a>

                <a href="https://wa.me/yourphonenumber" target="_blank" class="text-slate-400 hover:text-[#25D366] hover:-translate-y-1.5 transition-all duration-300">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.937 3.659 1.432 5.631 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg>
                </a>

                <a href="https://www.facebook.com/share/1XmcTZrjPe/" class="text-slate-400 hover:text-[#1877F2] hover:-translate-y-1.5 transition-all duration-300">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.03 1.464-5.935 5.545-5.935l3.133.001v3.666h-1.946c-1.416 0-1.513.53-1.513 1.525v2.323h3.487l-.451 3.667h-3.036v7.98H9.101z" /></svg>
                </a>

                <a href="https://www.instagram.com/celekki?igsh=MWVvZGY1cDN4bHo4bw==" class="text-slate-400 hover:text-[#E4405F] hover:-translate-y-1.5 transition-all duration-300">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                </a>

                <a href="https://x.com/celagoszone5" class="text-slate-400 hover:text-white hover:-translate-y-1.5 transition-all duration-300">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" /></svg>
                </a>

                <a href="https://youtube.com/@celekki?si=XZ505g3YwqbtI29q" class="text-slate-400 hover:text-[#FF0000] hover:-translate-y-1.5 transition-all duration-300">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" /></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-10 gap-x-16 gap-y-16">
            <div class="lg:col-span-4 space-y-8">
                <div class="group flex items-center gap-4">
                    <img src="images/logo.png" alt="Logo" class="h-12 w-auto object-contain brightness-110 group-hover:scale-105 transition-transform duration-500">
                    <div class="h-10 w-[1px] bg-white/10 hidden sm:block"></div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tight uppercase leading-none">Christ Embassy Lekki</h3>
                        <div class="mt-2 h-0.5 w-12 bg-blue-500 rounded-full group-hover:w-full transition-all duration-700 ease-in-out"></div>
                    </div>
                </div>
                <p class="text-base text-slate-400 leading-relaxed font-light max-w-md">
                    LoveWorld Incorporated, (a.k.a Christ Embassy) is a global ministry with a vision of taking God’s divine presence to the nations of the world and to demonstrate the character of the Holy Spirit.
                </p>
            </div>

            <div class="lg:col-span-3 space-y-8 lg:border-l lg:border-white/5 lg:pl-12">
                <div class="relative inline-block pb-3 mb-6">
                    <h4 class="text-sm font-bold text-white tracking-[0.3em] uppercase opacity-70">Useful Links</h4>
                    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-white/10"></div>
                    <div class="absolute bottom-0 left-0 w-12 h-[2px] bg-blue-500"></div>
                </div>
                <nav class="space-y-5">
                    <a href="/higher_life" class="group flex items-center gap-4 text-slate-400 hover:text-white transition-all duration-300">
                        <span class="p-2 rounded-lg bg-white/5 group-hover:bg-blue-600/20 transition-colors"><i data-lucide="home" class="w-4 h-4 text-blue-500"></i></span>
                        <span class="text-sm font-medium tracking-wide">Home</span>
                    </a>
                    <a href="/blog" class="group flex items-center gap-4 text-slate-400 hover:text-white transition-all duration-300">
                        <span class="p-2 rounded-lg bg-white/5 group-hover:bg-blue-600/20 transition-colors"><i data-lucide="info" class="w-4 h-4 text-blue-500"></i></span>
                        <span class="text-sm font-medium tracking-wide">About</span>
                    </a>
                    <a href="#" class="group flex items-center gap-4 text-slate-400 hover:text-white transition-all duration-300">
                        <span class="p-2 rounded-lg bg-white/5 group-hover:bg-blue-600/20 transition-colors"><i data-lucide="mic-2" class="w-4 h-4 text-blue-500"></i></span>
                        <span class="text-sm font-medium tracking-wide">Podcast</span>
                    </a>
                    <a href="/faq" class="group flex items-center gap-4 text-slate-400 hover:text-white transition-all duration-300">
                        <span class="p-2 rounded-lg bg-white/5 group-hover:bg-blue-600/20 transition-colors"><i data-lucide="help-circle" class="w-4 h-4 text-blue-500"></i></span>
                        <span class="text-sm font-medium tracking-wide">FAQ</span>
                    </a>
                </nav>
            </div>

            <div class="lg:col-span-3 space-y-8 lg:border-l lg:border-white/5 lg:pl-12">
                <div class="relative inline-block pb-3 mb-6">
                    <h4 class="text-sm font-bold text-white tracking-[0.3em] uppercase opacity-50">Contacts</h4>
                    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-white/10"></div>
                    <div class="absolute bottom-0 left-0 w-12 h-[2px] bg-blue-500"></div>
                </div>
                <div class="space-y-6">
                    <address class="not-italic flex items-start gap-5 text-slate-300 group">
                        <div class="mt-1 p-2 rounded-full bg-blue-600/10 text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm leading-relaxed font-light">
                            Loveworld Arena Lekki,<br>
                            Aare Bashiru street, Chisco B/S,<br>
                            Lekki-Epe Express Way
                        </span>
                    </address>

                    <a href="https://www.kingsch.at/h/nightofblessing" target="_blank" class="flex items-center gap-5 text-slate-400 hover:text-blue-400 transition-colors group">
                        <div class="p-2 rounded-full bg-blue-600/10 text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm font-medium">@nightofblessing</span>
                    </a>

                    <div class="flex items-center gap-5 text-slate-300 group">
                        <div class="p-2 rounded-full bg-blue-600/10 text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm font-bold tracking-tighter">+234 907 641 5312</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 bg-black/40 backdrop-blur-md border-t border-white/5 py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center gap-2">
            <p class="text-[10px] text-slate-500 font-medium tracking-[0.4em] uppercase text-center">
                © {{ date('Y') }} Copyright: <span class="text-slate-300">Christ Embassy Lekki</span>
            </p>
        </div>
    </div>
</footer>
</div>

        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            lucide.createIcons();

            function toggleChat() {
                const chatBox = document.getElementById('miniChatBox');
                chatBox.classList.toggle('hidden');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-F3G3TE2Z3Y"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-F3G3TE2Z3Y');
            gtag('config', 'G-MKLY83DXT5');
        </script>
        <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
        <script>
            window.OneSignalDeferred = window.OneSignalDeferred || [];
            OneSignalDeferred.push(async function(OneSignal) {
                await OneSignal.init({
                    appId: "04ae47b2-4947-45a7-835c-a129c7fb7296"
                });
            });
        </script>
        <script>
            window.addEventListener('load', () => {
                const loader = document.getElementById('loader');
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            });

            const video = document.getElementById('liveVideo');
            const offlineCover = document.getElementById('offlineCover');
            const liveStatus = document.getElementById('liveStatus');
            const streamUrl = "https://vcpout-sf01-altnetro.internetmultimediaonline.org/vcp/aa5ad237/playlist.m3u8";

            function updateUI(isLive) {
                if (isLive) {
                    offlineCover.classList.add('hidden');
                    liveStatus.textContent = "LIVE";
                    liveStatus.className =
                        "px-3 py-1 rounded-full text-xs font-bold uppercase bg-red-100 text-red-600 animate-pulse";
                } else {
                    offlineCover.classList.remove('hidden');
                    liveStatus.textContent = "OFFLINE";
                    liveStatus.className = "px-3 py-1 rounded-full text-xs font-bold uppercase bg-slate-200 text-slate-600";
                }
            }

            if (Hls.isSupported()) {
                const hls = new Hls({
                    maxMaxBufferLength: 10,
                    liveSyncDurationCount: 3
                });
                hls.loadSource(streamUrl);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, () => {
                    video.play().catch(() => {});
                    updateUI(true);
                });
                hls.on(Hls.Events.ERROR, (e, data) => {
                    if (data.fatal) updateUI(false);
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = streamUrl;
                video.addEventListener('loadedmetadata', () => {
                    video.play().catch(() => {});
                    updateUI(true);
                });
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const input = document.getElementById('startLocation');
                const button = document.getElementById('getDirectionsBtn');
                const destination = "Christ Embassy Lekki, LoveWorld Arena, Aare Bashiru Street, Lagos";

                const handleSearch = () => {
                    const start = input.value.trim();
                    if (start) {
                        // Encode the URI to handle spaces and special characters
                        const url =
                            `https://www.google.com/maps/dir/?api=1&origin=${encodeURIComponent(start)}&destination=${encodeURIComponent(destination)}&travelmode=driving`;
                        window.open(url, '_blank');
                    } else {
                        // Shake effect or alert if empty
                        input.classList.add('border-red-500');
                        setTimeout(() => input.classList.remove('border-red-500'), 1000);
                    }
                };

                // Click event
                button.addEventListener('click', handleSearch);

                // Enter key event
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') handleSearch();
                });
            });
        </script>
</x-app-layout>
