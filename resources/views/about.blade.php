<x-app-layout>
    <script src="https://unpkg.com/lucide@latest"></script>

    <main class="bg-white font-sans text-slate-900 overflow-x-hidden">

        <section class="relative h-[75vh] flex items-center justify-center overflow-hidden bg-slate-900">
    <div class="absolute inset-0 z-0">
        <img src="/images/pst-dee.jpg" 
             alt="Background Overlay" 
             class="w-full h-full object-cover opacity-30 scale-105 mix-blend-luminosity transform hover:scale-110 transition-transform duration-[10s] ease-out">
        
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 via-slate-900/40 to-slate-900/90"></div>
        <div class="absolute inset-0 bg-blue-900/20 mix-blend-multiply"></div>
    </div>

    <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_50%_50%,rgba(37,99,235,1)_0%,rgba(15,23,42,0)_70%)]"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-matter.png')] opacity-20"></div>
    
    <div class="relative z-10 text-center px-6 max-w-5xl mx-auto animate-fadeIn">
        <span class="inline-block py-2 px-5 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-400 text-xs font-black uppercase tracking-[0.4em] mb-8 backdrop-blur-sm">
            LoveWorld Incorporated
        </span>
        
        <h1 class="text-5xl md:text-8xl font-black text-white mb-8 leading-[1.1] tracking-tight drop-shadow-2xl">
            Taking God's Presence <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-300">to the Nations</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-slate-200 font-medium leading-relaxed max-w-3xl mx-auto opacity-90 drop-shadow-md">
            A global ministry driven by a passion to see men and women discover the divine life in Christ Jesus.
        </p>

        <div class="mt-10 flex justify-center items-center gap-4">
            <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-blue-500"></div>
            <span class="text-blue-400 font-bold uppercase tracking-widest text-xs">Establishment in Glory</span>
            <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-blue-500"></div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white to-transparent"></div>
</section>

       <section class="py-32 px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
        <div class="lg:col-span-5 reveal-left">
            <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight">
                <span class="premium-underline-container text-slate-900">Who We Are</span>
            </h2>
            <p class="text-xl text-blue-600 font-black uppercase tracking-[0.3em] mb-6">LoveWorld Incorporated</p>
            <p class="text-lg text-slate-600 leading-relaxed font-medium mb-6">
                Christ Embassy is not just a local assembly; it’s a vision. The Lord has called us to fulfill a very definite purpose, which is to take His divine presence to the peoples and nations of the world.
            </p>
        </div>
        <div class="lg:col-span-7 reveal-right">
            <div class="relative p-8 md:p-12 bg-slate-900 rounded-[3rem] text-white shadow-2xl overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 blur-3xl rounded-full -mr-20 -mt-20"></div>
                <i data-lucide="quote" class="w-12 h-12 text-blue-500 opacity-50 mb-6"></i>
                <p class="text-2xl md:text-3xl font-light italic leading-relaxed relative z-10">
                    "This is achieved through every available means, as the Ministry is driven by a passion to see men and women all over the world come to the knowledge of the divine life made available in Christ Jesus."
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group p-10 rounded-[3rem] bg-white border border-slate-200 hover:shadow-2xl transition-all duration-500 reveal-up">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
                    <i data-lucide="crosshair" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-black mb-4">Our Vision</h3>
                <p class="text-slate-600 leading-relaxed font-medium">To take His divine presence to the peoples and nations of the world, and to demonstrate the character of His Spirit.</p>
            </div>

            <div class="group p-10 rounded-[3rem] bg-slate-900 text-white shadow-xl reveal-up" style="transition-delay: 100ms;">
                <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mb-8">
                    <i data-lucide="sparkles" class="w-6 h-6 text-white"></i>
                </div>
                <h3 class="text-2xl font-black mb-4 text-white">More Than A Church</h3>
                <p class="text-slate-400 leading-relaxed font-medium">You become part of something that’s more than a church; you become part of God's vision for your life.</p>
            </div>

            <div class="group p-10 rounded-[3rem] bg-white border border-slate-200 hover:shadow-2xl transition-all duration-500 reveal-up" style="transition-delay: 200ms;">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
                    <i data-lucide="sun" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-black mb-4">Life Meaning</h3>
                <p class="text-slate-600 leading-relaxed font-medium">One Word from God will revolutionize your life forever, establishing blessings in every area.</p>
            </div>
        </div>
    </div>
</section>


<section class="py-24 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 reveal-up">
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">Worship With Us</h2>
            <p class="text-slate-500 font-medium tracking-wide uppercase text-sm">Experience the Miraculous in our Weekly & Monthly Meetings</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6 reveal-left">
                <h3 class="flex items-center gap-3 text-2xl font-black text-slate-900 mb-8">
                    <span class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <i data-lucide="calendar-days" class="w-5 h-5"></i>
                    </span>
                    Monthly Meetings
                </h3>
                
                <div class="group bg-white p-8 rounded-[2rem] border border-slate-200 hover:border-blue-500 transition-all duration-500 shadow-sm hover:shadow-xl relative overflow-hidden">
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <span class="text-blue-600 font-bold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full">Global Event</span>
                            <h4 class="text-2xl font-black text-slate-900 mt-3">Communion Service</h4>
                            <p class="text-slate-500 font-bold">With Pastor Chris Oyakhilome</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-900 font-black text-lg">3:00 PM</p>
                            <p class="text-slate-500 text-sm font-medium">Every 1st Sunday</p>
                        </div>
                    </div>
                </div>

                <div class="group bg-white p-8 rounded-[2rem] border border-slate-200 hover:border-blue-500 transition-all duration-500 shadow-sm hover:shadow-xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-orange-600 font-bold text-xs uppercase tracking-widest bg-orange-50 px-3 py-1 rounded-full">Prayer & Prophecy</span>
                            <h4 class="text-2xl font-black text-slate-900 mt-3">Zonal Manifestation Rally</h4>
                            <p class="text-slate-500 font-bold">Lagos Zone 5</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-900 font-black text-lg">6:00 AM</p>
                            <p class="text-slate-500 text-sm font-medium">Every 1st Saturday</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal-right">
                <h3 class="flex items-center gap-3 text-2xl font-black text-slate-900 mb-8">
                    <span class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </span>
                    Weekly Meetings
                </h3>
                <div class="bg-white rounded-[2.5rem] border border-slate-200 divide-y divide-slate-100 overflow-hidden shadow-sm">
                    <div class="p-8 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div>
                            <p class="font-black text-xl text-slate-900">Sunday Service</p>
                            <p class="text-slate-500 font-medium">Main Celebration</p>
                        </div>
                        <div class="text-right">
                            <p class="text-blue-600 font-black text-lg">7:00 AM & 9:00 AM</p>
                            <p class="text-slate-400 text-xs font-bold uppercase">Weekly</p>
                        </div>
                    </div>
                    <div class="p-8 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div>
                            <p class="font-black text-xl text-slate-900">Mid-Week Service</p>
                            <p class="text-slate-500 font-medium">Word & Transformation</p>
                        </div>
                        <div class="text-right">
                            <p class="text-blue-600 font-black text-lg">6:30 PM</p>
                            <p class="text-slate-400 text-xs font-bold uppercase">Wednesdays</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-32 px-6">
    <div class="max-w-7xl mx-auto bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[4rem] relative overflow-hidden shadow-2xl">
        <div class="relative z-10 px-8 py-20 text-center text-white">
            <h2 class="text-4xl md:text-5xl font-black mb-6 reveal-up">Be a Kingdom Advancer</h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-10 font-medium reveal-up">Join us in reaching the world for Jesus Christ. Your life will never be the same again.</p>
            <div class="flex flex-col md:flex-row gap-6 justify-center items-center reveal-up">
                <a href="#" class="px-10 py-5 bg-white text-blue-600 font-black rounded-full hover:bg-slate-900 hover:text-white transition-all transform hover:scale-105 shadow-xl">
                    Serve Him Together
                </a>
            </div>
        </div>
    </div>
</section>

    </main>

    <style>
        /* Premium Underline (Matching Footer/Testimonials) */
        .premium-underline-container {
            position: relative;
            padding-bottom: 24px;
            display: inline-block;
        }
        
        .premium-underline-container::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 7px;
            background-color: #2563eb;
            border-radius: 99px;
        }

        .premium-underline-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 82px;
            width: 25px;
            height: 7px;
            background-color: #2563eb;
            border-radius: 99px;
            opacity: 0.4;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 1.2s ease-out forwards; }

        .reveal-up { opacity: 0; transform: translateY(40px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1); }
        
        .visible {
            opacity: 1 !important;
            transform: translate(0, 0) !important;
        }
    </style>


<div class="fixed bottom-8 right-8 z-[100] flex flex-col-reverse items-center gap-4 group">
    
    <button id="socialToggle" 
            class="w-16 h-16 bg-blue-600 text-white rounded-full shadow-2xl shadow-blue-900/40 flex items-center justify-center transition-all duration-500 hover:scale-110 active:scale-95 z-20 relative">
        <i data-lucide="message-circle" id="chatIcon" class="w-8 h-8 absolute transition-all duration-500"></i>
        <i data-lucide="x" id="closeIcon" class="w-8 h-8 absolute transition-all duration-500 opacity-0 rotate-[-90deg]"></i>
    </button>

    <div id="socialList" class="flex flex-col-reverse items-center gap-4 mb-2 pointer-events-none opacity-0 translate-y-10 transition-all duration-500">
        
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
    .menu-active .social-item:nth-child(1) { transition-delay: 50ms; }
    .menu-active .social-item:nth-child(2) { transition-delay: 100ms; }
    .menu-active .social-item:nth-child(3) { transition-delay: 150ms; }
    .menu-active .social-item:nth-child(4) { transition-delay: 200ms; }
    .menu-active .social-item:nth-child(5) { transition-delay: 250ms; }
</style>


<footer class="bg-slate-900 text-slate-300 pt-20 pb-10 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-20">
            
            <div class="space-y-6 reveal-fade">
                <h3 class="text-white text-xl font-bold">
                    <span class="footer-underline">About Us</span>
                </h3>
                <p class="leading-relaxed text-slate-400 font-medium">
                    We are a global ministry with a vision to take the divine presence of God to the peoples and nations of the world. At Christ Embassy, we demonstrate the character of the Spirit and empower lives through the Word.
                </p>
                <div class="pt-4">
                    <div class="inline-flex items-center space-x-2 bg-blue-600/10 text-blue-400 px-4 py-2 rounded-full text-sm font-bold border border-blue-500/20">
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
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Our Vision & Mission
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Upcoming Events
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Give Online
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
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
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <span class="text-slate-400 pt-1 font-medium"> Loveworld Arena Lekki,
                             Aare Bashiru street, Chisco B/S, Lekki-Epe Express Way</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <span class="text-slate-400 pt-1 font-medium">+234 907 641 5312</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
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
        background-color: #2563eb; /* Blue-600 */
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Lucide Icons
            lucide.createIcons();

            // Scroll Observer for stunning reveal effects
            const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
        });
    </script>
</x-app-layout>