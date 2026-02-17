<x-app-layout>
    <script src="https://unpkg.com/lucide@latest"></script>

    <main class="bg-white font-sans text-slate-900 overflow-x-hidden">

        <section class="relative h-[60vh] flex items-center justify-center overflow-hidden bg-slate-900">
            <div class="absolute inset-0 z-0">
                <img src="/images/pst-dee.jpg" alt="Contact Background"
                    class="w-full h-full object-cover opacity-30 mix-blend-luminosity">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 via-transparent to-white"></div>
                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(37,99,235,0.2)_0%,transparent_100%)]">
                </div>
            </div>

            <div class="relative z-10 text-center px-6 max-w-5xl mx-auto animate-fadeIn">
                <span
                    class="inline-block py-2 px-5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-black uppercase tracking-[0.4em] mb-8">
                    Get In Touch
                </span>
                <h1 class="text-5xl md:text-8xl font-black text-white mb-8 leading-[1.1] tracking-tight">
                    Let’s Connect <br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-300">With
                        You</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 font-medium leading-relaxed max-w-2xl mx-auto opacity-90">
                    Have questions about our services or want to share a testimony? Our team is here to listen and pray
                    with you.
                </p>
            </div>
        </section>

        <section class="relative z-20 -mt-24 pb-32 px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">

                <div class="lg:col-span-5 space-y-8 reveal-left">
                    <div
                        class="bg-slate-900 rounded-[3rem] p-10 md:p-14 text-white shadow-2xl relative overflow-hidden h-full">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 blur-3xl rounded-full -mr-32 -mt-32">
                        </div>

                        <h2 class="text-3xl font-black mb-12">Contact <br><span class="text-blue-400">Information</span>
                        </h2>

                        <div class="space-y-10">
                            <div class="flex items-start gap-6 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-1">Our
                                        Location</p>
                                    <p class="text-lg font-medium text-slate-200"> Loveworld Arena Lekki, Aare Bashiru
                                        <br> street, Chisco B/S,Lekki-Epe Express Way</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-6 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                    <i data-lucide="phone" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-1">Call Us
                                    </p>
                                    <p class="text-lg font-medium text-slate-200">+234 907 641 5312</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-6 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                    <i data-lucide="mail" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-1">Email Us
                                    </p>
                                    <p class="text-lg font-medium text-slate-200">contact@loveworld.org</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-20 pt-10 border-t border-white/10">
                            <p class="text-slate-500 text-sm italic font-medium">Available 24/7 for prayer requests and
                                inquiries.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 reveal-right">
                    <div class="bg-white rounded-[3rem] p-10 md:p-14 border border-slate-100 shadow-xl h-full">
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                            @csrf

                            @if (session('status'))
                                <div
                                    class="bg-emerald-500 text-white px-6 py-4 rounded-2xl font-bold shadow-lg shadow-emerald-200">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="bg-red-500 text-white px-6 py-4 rounded-2xl font-bold shadow-lg shadow-red-200">
                                    Please fix the errors below and try again.
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-sm font-black uppercase tracking-widest text-slate-400 ml-1">Full
                                        Name</label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                                        placeholder="John Doe"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-900 placeholder:text-slate-300">
                                    @error('full_name')
                                        <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-black uppercase tracking-widest text-slate-400 ml-1">Email
                                        Address</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="john@example.com"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-900 placeholder:text-slate-300">
                                    @error('email')
                                        <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-black uppercase tracking-widest text-slate-400 ml-1">Your
                                    Message</label>
                                <textarea name="message" rows="6" placeholder="How can we help you today?"
                                    class="w-full bg-slate-50 border-none rounded-[2rem] px-6 py-4 focus:ring-2 focus:ring-blue-500 transition-all font-medium text-slate-900 placeholder:text-slate-300">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs font-bold ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="group relative inline-flex items-center justify-center px-10 py-5 font-black text-white bg-blue-600 rounded-full overflow-hidden transition-all duration-300 hover:bg-slate-900 hover:scale-105 active:scale-95 shadow-xl shadow-blue-200">
                                <span class="relative z-10 flex items-center gap-3">
                                    Send Message
                                    <i data-lucide="send"
                                        class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 text-center max-w-4xl mx-auto reveal-up">
            <h2 class="text-3xl md:text-4xl font-black mb-6">Need Immediate Prayer?</h2>
            <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">
                You can reach our 24/7 prayer lines to speak with a minister. We believe that a prayer away is a miracle
                away.
            </p>
            <div class="h-1 w-20 bg-blue-600 mx-auto rounded-full opacity-30"></div>
        </section>

    </main>

    <style>
        /* Shared Scroll Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .visible {
            opacity: 1 !important;
            transform: translate(0, 0) !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 1.2s ease-out forwards;
        }

        input:focus,
        textarea:focus {
            outline: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right').forEach(el => observer.observe(
            el));
        });
    </script>


    <div class="fixed bottom-8 right-8 z-[100] flex flex-col-reverse items-center gap-4 group">

        <button id="socialToggle"
            class="w-16 h-16 bg-blue-600 text-white rounded-full shadow-2xl shadow-blue-900/40 flex items-center justify-center transition-all duration-500 hover:scale-110 active:scale-95 z-20 relative">
            <i data-lucide="message-circle" id="chatIcon" class="w-8 h-8 absolute transition-all duration-500"></i>
            <i data-lucide="x" id="closeIcon"
                class="w-8 h-8 absolute transition-all duration-500 opacity-0 rotate-[-90deg]"></i>
        </button>

        <div id="socialList"
            class="flex flex-col-reverse items-center gap-4 mb-2 pointer-events-none opacity-0 translate-y-10 transition-all duration-500">

            <a href="https://wa.me/yourlink" target="_blank"
                class="social-item w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="WhatsApp">
                <i data-lucide="message-square" class="w-5 h-5"></i>
            </a>

            <a href="https://www.instagram.com/celekki?igsh=MWVvZGY1cDN4bHo4bw==" target="_blank"
                class="social-item w-12 h-12 bg-gradient-to-tr from-yellow-500 via-red-500 to-purple-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="Instagram">
                <i data-lucide="instagram" class="w-5 h-5"></i>
            </a>

            <a href="tiktok.com/@christembassylekki" target="_blank"
                class="social-item w-12 h-12 bg-black text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="TikTok">
                <i data-lucide="music-2" class="w-5 h-5"></i>
            </a>

            <a href="https://x.com/celagoszone5" target="_blank"
                class="social-item w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="X (Twitter)">
                <i data-lucide="twitter" class="w-5 h-5"></i>
            </a>

            <a href="https://www.facebook.com/share/1XmcTZrjPe/" target="_blank"
                class="social-item w-12 h-12 bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="Facebook">
                <i data-lucide="facebook" class="w-5 h-5"></i>
            </a>

            <a href="" target="_blank"
                class="social-item w-12 h-12 bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="YouTube">
                <i data-lucide="youtube" class="w-5 h-5"></i>
            </a>

            <a href="https://www.kingsch.at/p/eUM3MVd" target="_blank"
                class="social-item w-12 h-12 bg-blue-400 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
                title="KingsChat">
                <img src="/images/kingschat.png" alt="">
            </a>
        </div>
    </div>

    <style>
        /* Class applied via JS to show the menu */
        .menu-active #socialList {
            opacity: 1 !important;
            translate: 0 0 !important;
            pointer-events: auto !important;
        }

        /* Rotate and Swap Main Icons */
        .menu-active #chatIcon {
            opacity: 0;
            rotate: 90deg;
        }

        .menu-active #closeIcon {
            opacity: 1;
            rotate: 0deg;
        }

        /* Staggered entrance for each icon */
        .menu-active .social-item:nth-child(1) {
            transition-delay: 50ms;
        }

        .menu-active .social-item:nth-child(2) {
            transition-delay: 100ms;
        }

        .menu-active .social-item:nth-child(3) {
            transition-delay: 150ms;
        }

        .menu-active .social-item:nth-child(4) {
            transition-delay: 200ms;
        }

        .menu-active .social-item:nth-child(5) {
            transition-delay: 250ms;
        }
    </style>


    <footer class="bg-slate-900 text-slate-300 pt-20 pb-10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-20">

                <div class="space-y-6 reveal-fade">
                    <h3 class="text-white text-xl font-bold">
                        <span class="footer-underline">About Us</span>
                    </h3>
                    <p class="leading-relaxed text-slate-400 font-medium">
                        We are a global ministry with a vision to take the divine presence of God to the peoples and
                        nations of the world. At Christ Embassy, we demonstrate the character of the Spirit and empower
                        lives through the Word.
                    </p>
                    <div class="pt-4">
                        <div
                            class="inline-flex items-center space-x-2 bg-blue-600/10 text-blue-400 px-4 py-2 rounded-full text-sm font-bold border border-blue-500/20">
                            <i data-lucide="globe" class="w-4 h-4"></i>
                            <span>Fulfilling Divine Purpose</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 reveal-fade" style="transition-delay: 150ms;">
                    <h3 class="text-white text-xl font-bold">
                        <span class="footer-underline">Quick Links</span>
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="#"
                                class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                                <i data-lucide="chevron-right"
                                    class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                                Our Vision & Mission
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                                <i data-lucide="chevron-right"
                                    class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                                Upcoming Events
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                                <i data-lucide="chevron-right"
                                    class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                                Give Online
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                                <i data-lucide="chevron-right"
                                    class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                                Partnership
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="space-y-6 reveal-fade" style="transition-delay: 300ms;">
                    <h3 class="text-white text-xl font-bold">
                        <span class="footer-underline">Contact Us</span>
                    </h3>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <span class="text-slate-400 pt-1 font-medium"> Loveworld Arena Lekki,
                                Aare Bashiru street, Chisco B/S, Lekki-Epe Express Way</span>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <span class="text-slate-400 pt-1 font-medium">+234 907 641 5312</span>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <span class="text-slate-400 pt-1 font-medium text-blue-400">contact@celekki.org</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-10 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-sm font-medium text-slate-500 italic">
                    &copy; 2026 Christ Embassy. All rights reserved.
                </p>
                <div class="text-sm font-bold tracking-widest uppercase text-slate-600">
                    Lekki church
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Premium Footer Underline Styles */
        .footer-underline {
            position: relative;
            padding-bottom: 12px;
            display: inline-block;
        }

        .footer-underline::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 4px;
            background-color: #2563eb;
            /* Blue-600 */
            border-radius: 99px;
        }

        .footer-underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 48px;
            width: 12px;
            height: 4px;
            background-color: #2563eb;
            border-radius: 99px;
            opacity: 0.4;
        }

        /* Animation: Fade Up Effect */
        .reveal-fade {
            opacity: 0;
            transform: translateY(20px);
            animation: revealFadeUp 0.8s ease-out forwards;
        }

        @keyframes revealFadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        // Initialize Icons
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Lucide Icons
            lucide.createIcons();

            const toggleBtn = document.getElementById('socialToggle');
            const container = toggleBtn.parentElement;

            toggleBtn.addEventListener('click', () => {
                container.classList.toggle('menu-active');
            });

            // Optional: Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!container.contains(e.target) && container.classList.contains('menu-active')) {
                    container.classList.remove('menu-active');
                }
            });
        });
    </script>

</x-app-layout>
